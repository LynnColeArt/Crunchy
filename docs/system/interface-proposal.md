

# Crunchy Interface Options

## Overview
Crunchy aims to accommodate a wide range of users with varying skill levels, comfort zones, and needs. To achieve this, three distinct interface options are proposed:
1. **Command Line with Parameters**
2. **Command Line Menu**
3. **Browser-Based Interface with Embedded Server**

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
    ```

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

## 3. Browser-Based Interface with Embedded Server
This interface is designed for **users who prefer a graphical interface** but without the need for a full desktop GUI.

### How It Works:
- Running the following command starts a lightweight server:
    ```bash
    crunchy serve
    ```
    Output:
    ```
    Crunchy web interface available at http://localhost:8080
    ```

### Features:
- **Simple, Responsive UI**: Built using modern web frameworks like React, Vue, or Svelte.
- **Accessible Menus**: Users can upload files, configure settings, and navigate easily.
- **Live Previews**: Real-time MIDI playback and effect previews.
- **Persistence**: Save configurations for later reuse.

### Example Web Interface:
- **Dashboard**:
  - Buttons for "Compile Music," "Manage Profiles," and "Export Formats."
  - File upload areas for inputs and outputs.
- **Dynamic Forms**:
  - Dropdowns and sliders to adjust instrument profiles and effects.
- **Feedback**:
  - Visual success/failure messages after tasks are completed.

---

## Implementation Notes
- Use **Go's built-in HTTP server** (`net/http`) for the browser-based interface.
- Ensure **shared logic** for consistency across CLI and browser interfaces.
- Design for **flexibility and modularity**:
  - Add new features without changing the interaction model.
  - Keep the data pipeline (file parsing, profile handling) consistent.

---

## Summary
By implementing these three interface options, Crunchy will provide:
1. **Command Line with Parameters**: For automation and advanced users.
2. **Command Line Menu**: For guided, user-friendly terminal usage.
3. **Browser Interface**: For an accessible, polished experience.

This approach ensures Crunchy meets the needs of diverse user groups while maintaining scalability and efficiency.
