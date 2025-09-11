I'll scan the key source and config files to tailor the README: entrypoint, service worker behavior, and configuration keys.
Read file: ProdIot_PLC_Service/ProdIot_PLC_Service/Program.cs
Read file: ProdIot_PLC_Service/ProdIot_PLC_Service/Worker.cs
Read file: ProdIot_PLC_Service/ProdIot_PLC_Service/AppConfig.cs
Read file: ProdIot_PLC_Service/ProdIot_PLC_Service/ProdiotPLCService.cs
Read file: ProdIot_PLC_Service/ProdIot_PLC_Service/appsettings.json

I'm going to open the core source and config files to tailor an accurate README: the entrypoint, worker/service logic, and configuration JSONs.
Read file: Program.cs
Read file: Worker.cs
Read file: AppConfig.cs
Read file: ProdiotPLCService.cs
Read file: appsettings.json
Read file: appsettings.Development.json
Read file: config.json
Let me read the main source and config files so the README reflects actual behavior and configuration.
Read file: ProdIot_PLC_Service/Program.cs
Read file: ProdIot_PLC_Service/Worker.cs
Read file: ProdIot_PLC_Service/ProdiotPLCService.cs
Read file: ProdIot_PLC_Service/AppConfig.cs
Read file: ProdIot_PLC_Service/appsettings.json

### I read your code to tailor this. I’ll paste a complete, ready-to-use README below.

```markdown
# ProdIot PLC Service (S7 ↔ MQTT Bridge)

Windows Service built on .NET 8 that:
- Connects to a Siemens S7 PLC (via S7.Net)
- Subscribes to MQTT commands to write PLC tags
- Periodically reads PLC tags and publishes value changes to the ProdIot cloud via HTTPS

## Features
- **PLC**: S7-1200 supported (uses `S7.Net.Plc`)
- **MQTT**: Connects to `mqtt.prodiot.com:1883`
- **Telemetry**: Sends changes to `https://prodiot.com/pi/{ClientId}/{DeviceName}/{address}/{value}`
- **Config file**: `config.json` (co-located with the executable)
- **Runs as Windows Service** (can also run interactively for debugging)

## Repo structure (key files)
- `ProdIot_PLC_Service/Program.cs`: App entrypoint, Windows Service host
- `ProdIot_PLC_Service/ProdiotPLCService.cs`: Core logic (PLC, MQTT, telemetry)
- `ProdIot_PLC_Service/AppConfig.cs`: Configuration model
- `ProdIot_PLC_Service/appsettings.json`: Logging config
- `PLCserviceInstaller/Release/setup.exe`: MSI installer (optional)

## Configuration

Create a `config.json` next to `ProdIot_PLC_Service.exe`:

```json
{
  "DeviceName": "MyMachine01",
  "ClientId": "YOUR_CLIENT_ID",
  "Secretkey": "YOUR_SECRET_KEY",
  "PlcIpAddress": "192.168.0.10"
}
```

- **DeviceName**: Unique device identifier
- **ClientId**: Your ProdIot client ID
- **Secretkey**: Your ProdIot secret key
- **PlcIpAddress**: PLC IP (S7-1200)

On startup, the service loads `config.json` from the executable folder. If it’s missing or invalid, the service exits.

## PLC Address formats

Supported formats (examples):
- Inputs: `I0.0`, `I1.3`, `I2` (bit or byte)
- Outputs: `Q0.0`, `Q1.1`, `Q2`
- Memory: `M0.0`, `M10`, `MD20` (DWord with `D` prefix)
- Data Blocks:
  - Bits: `DB1.DBX0.0`
  - Bytes: `DB1.DBB0`
  - Words: `DB1.DBW0`
  - DWords: `DB1.DBD0` or `DB1.DBL0`

Notes:
- Bit addresses can use dot notation (e.g., `I0.0`, `DB1.DBX0.1`)
- DWord reading supported via `D`/`DBD`/`DBL`

## Cloud communication

- On interval, reads the current list of monitored addresses.
- If a value changed since last read, makes a GET request:
  - `https://prodiot.com/pi/{ClientId}/{DeviceName}/{address}/{value}`

Monitored addresses are fetched on connect (and reconnect) from:
- `https://prodiot.com/pi/{ClientId}/{DeviceName}/parameterlist`
  - Accepts either:
    - Raw JSON array: `["I0.0","Q0.0","DB1.DBX0.0"]`
    - Or JSON object with `parameterlist` key

## MQTT

- Broker: `mqtt.prodiot.com:1883`
- Topic subscribed: `pi/{ClientId}/{DeviceName}`

Payload types:
1) Set monitored addresses (replace list):
```json
["I0.0","Q0.0","DB1.DBX0.0"]
```

2) Write values to PLC (boolean semantics: 1/0/true/false):
```json
{
  "Q0.0": 1,
  "DB1.DBX0.0": false
}
```

Value parsing rules for writes:
- Integers: `1` → true, `0` → false
- Strings: `"true"`/`"1"` → true; otherwise false
- Booleans: `true`/`false` supported

## Build

Prereqs: .NET 8 SDK

```powershell
# From the repo root
dotnet restore
dotnet build -c Release
```

Publish (folder):
```powershell
dotnet publish ProdIot_PLC_Service/ProdIot_PLC_Service.csproj -c Release -r win-x64 --self-contained false -o .\publish
```

Copy `config.json` into the `publish` output folder.

## Run (interactive)

```powershell
# Run from publish output folder (shows console logs)
.\ProdIot_PLC_Service.exe
```

## Install as a Windows Service

Option A: Use the provided installer
- Run: `PLCserviceInstaller/Release/setup.exe`

Option B: Manual install with `sc`
```powershell
# Adjust the path to your publish output
$exe = "C:\Path\To\publish\ProdIot_PLC_Service.exe"

sc.exe create ProdiotPLCService binPath= "`"$exe`"" start= auto
sc.exe start ProdiotPLCService

# Stop / remove if needed
# sc.exe stop ProdiotPLCService
# sc.exe delete ProdiotPLCService
```

Place `config.json` in the same folder as the `.exe` before starting the service.

## Networking

- Outbound:
  - HTTPS to `prodiot.com` (port 443)
  - MQTT to `mqtt.prodiot.com` (port 1883)
- Local network access to the PLC IP (TCP/102 typically for S7)

Ensure firewall rules allow these.

## Logs & Troubleshooting

- When run interactively, logs are written to console output.
- Common issues:
  - “config.json not found” → Ensure it’s next to the `.exe`
  - PLC not connecting → Check `PlcIpAddress`, PLC is reachable, and S7 communication is enabled
  - MQTT not connecting → Ensure outbound access to `mqtt.prodiot.com:1883`

## Security notes

- MQTT credentials are set in code. Change them in `ProdiotPLCService.cs` before production.
- Do not commit real `ClientId`/`Secretkey` to version control.

## License

Proprietary (update as needed).
```

- Want me to drop this into a `README.md` in the repo or tweak sections (e.g., service name, installer-first flow)?
