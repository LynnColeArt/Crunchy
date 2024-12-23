
# Crunchy Interface Options

## Table of Contents

1. [Overview](#overview)
2. [Command Line with Parameters](#1-command-line-with-parameters)
   - [Example Command](#example-command)
   - [Advanced Multi-Layer Setup](#advanced-multi-layer-setup)
3. [Command Line Menu](#2-command-line-menu)
   - [Example Workflow](#example-workflow)
   - [Benefits](#benefits)
4. [Manage Flag: Interactive Layer Editing](#manage-flag-interactive-layer-editing)
   - [Key Features](#key-features)
   - [Example Workflow in Editor](#example-workflow-in-editor)
5. [API Mirroring CLI](#api-mirroring-cli)
6. [Enabling or Disabling the API](#enabling-or-disabling-the-api)
7. [Implementation Notes](#implementation-notes)
8. [Success Message](#success-message)
9. [Version History](#version-history)
10. [Summary](#summary)

---

## Overview

Crunchy aims to accommodate a wide range of users with varying skill levels, comfort zones, and needs. To achieve this, three distinct interface options are proposed:

1. **Command Line with Parameters**
2. **Command Line Menu**
3. **Interactive Editor via `manage`**

Each option ensures flexibility, accessibility, and scalability, catering to diverse user preferences.

---

## 1. Command Line with Parameters

This interface is designed for **advanced users** who prefer quick, scriptable interactions. Also useful for creating automated processes where music needs to be transformed at scale using batch processes.

### Example Command:

```bash
crunchy compile --input="input.mid" --output="output.midi" --instrument="piano" --effect="reverb"
```

### Features:

- **Direct and Fast**: Ideal for automation and scripting.
- **Help System**: Users can access available parameters with a `--help` flag.
  ```bash
  crunchy compile --help
  ```
  Example Output:
  ```
  Compile Options:
    --input       Path to input file
    --output      Path to output file
    --instrument  Specify instrument profile
    --effect      Add effects (e.g., reverb, echo)
    --region      Specify cultural region configurations
    --style       Apply predefined regional styles (e.g., maqam, Shruti scale)
    --tuning-system  Define custom tuning systems
    --layers      Add advanced layer-specific attributes
    --global-playstyle  Set a global playstyle for all layers
    --add-input   Append additional MusicXML files as separate layers
    --validate    Run validation checks on the input
    --verbose     Provide detailed logs for debugging
    --preview     Enable playback or visualization previews
    --output-format Specify the desired export format
    --modifier    Apply modifiers to layers or globally
    --set-tuning  Apply specific tuning configurations
    --tuning-preset Select predefined tuning systems
    --microtonal-division  Define divisions for microtonal systems
    --validate-tuning Validate tuning for compatibility
    --adjust-tuning   Automatically adjust tuning for predefined styles
    --tuning-map  Provide a detailed map for custom tuning frequencies
  ```

### Advanced Multi-Layer Setup

Crunchy treats multiple input files as distinct layers, enabling complex workflows:

```bash
crunchy compile --input=violin.musicxml --add-input=flute.musicxml --layers     "layer1:instrument=violin,playstyle=legato"     "layer2:instrument=flute,tuning=C4-E4-G4-A4,playstyle=staccato"
```

- **Automatic Layer Handling**: Each input file corresponds to a unique layer.
- **Layer-Specific Attributes**: Instruments, playstyles, and modifiers are applied per layer.
- **Unified Export**: Merges all layers into a single output while preserving individual attributes.

---

## 2. Command Line Menu

This interface is designed for **users who prefer simplicity** but are comfortable with terminal usage.

### Example Workflow:

```bash
crunchy
```

#### Output:

```
Welcome to Crunchy!
Select an option:
[1] Compile Music
[2] Manage Instrument Profiles
[3] Export Formats
[4] Help
```

- Users navigate interactively by entering numbers (e.g., `1` for Compile Music).
- Subsequent prompts guide users through the process interactively:
  ```
  Enter input file path:
  > input.mid
  Enter output file path:
  > output.midi
  Select instrument:
  > piano
  Add effects? (reverb, echo, none):
  > reverb
  ```

#### Benefits:

- Friendly for users who need guidance without overwhelming them with options.
- Reduces the learning curve for first-time users.

---

## Manage Flag: Interactive Layer Editing

The `manage` flag launches an interactive editor for dynamic composition and layer management.

### Key Features:

1. **Preloaded Configuration**:

   - Pass input files, layers, or regional configurations via flags to preload the editor.
   - Example:
     ```bash
     crunchy manage --input=violin.musicxml --add-input=flute.musicxml --layers          "layer1:instrument=violin,playstyle=legato"          "layer2:instrument=flute,playstyle=staccato"
     ```

2. **Real-Time Layer Adjustments**:

   - Modify instruments, playstyles, tunings, and modifiers.
   - Visualize errors or misalignments between layers.

3. **Playback Previews**:

   - Test individual layers or the combined composition.

4. **Unified Export Options**:

   - Save configurations as `.musicxml` or `.midi` directly from the editor.

### Example Workflow in Editor:

```
[Layer 1: Violin]
Instrument: Violin
Playstyle: Legato
Modifiers: None
Tuning: Standard G3-D4-A4-E5

[Layer 2: Flute]
Instrument: Flute
Playstyle: Staccato
Modifiers: Reverb (50%)
Tuning: Custom C4-E4-G4-A4
```

---

## API Mirroring CLI

The API mirrors the advanced command-line functionality, excluding the interactive `manage` mode. It allows programmatic access to:

- Multi-layer handling with configurations for instruments, tunings, and playstyles.
- Validation and error reporting for MusicXML and MIDI files.
- Exporting files in the requested format or as a data stream for external applications.
- Streaming status updates for individual renders, enabling real-time progress tracking.

### API Endpoints

**Authentication:**
- Basic authentication is supported but optional and disabled by default.
- When enabled, credentials can be provided via HTTP Basic Auth headers.

1. **`POST /compile`**

   - **Streaming Progress**: For individual renders, the server streams progress updates as the render advances. Example output:
     ```json
     {
         "status": "in_progress",
         "progress": "60%",
         "message": "Applying tuning map"
     }
     ```

   - For batch renders, progress can include statuses of all files in the batch, updated periodically:
     ```json
     [
         {"file": "track1.midi", "status": "completed"},
         {"file": "track2.midi", "status": "in_progress", "progress": "40%}
     ]
     ```

---

## Enabling or Disabling the API

The API can be enabled or disabled through the following configuration options:

### 1. Configuration File
- Include an `api` section in the `config.json` file:
  ```json
  {
    "api": {
      "enabled": true,
      "port": 8080,
      "authentication": false
    }
  }
  ```
- Set `enabled` to `false` to disable the API.
- Set `authentication` to `true` to enable optional Basic Auth.

### 2. Environment Variable
- Toggle the API through environment variables:
  ```bash
  CRUNCHY_API_ENABLED=true
  CRUNCHY_API_AUTH=false
  ```

### 3. Command-Line Argument
- Override the configuration via CLI flags:
  ```bash
  crunchy serve --disable-api
  crunchy serve --enable-api --auth
  ```

### Default Behavior
- By default, the API is **enabled** without authentication.
- Requests to the API when disabled return an HTTP `503 Service Unavailable` status.

---

## Version History

### v0.1.4

- Removed the web-based interface proposal.
- Expanded flags for tuning, regional configurations, and validation workflows.
- Added streaming progress updates and API configuration options.

### v0.1.3

- Introduced celebratory success messaging upon export completion.

### v0.1.2

- Introduced the `manage` interactive flag for real-time editing.

