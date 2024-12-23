
# Music Notation Transpiler Specification

**Version 0.1.5**

## Overview

This document provides a comprehensive specification for the Crunchy Transpiler, a versatile music notation converter. Designed to preserve musical fidelity and support diverse formats, the transpiler adopts a modular approach, enabling compatibility with both traditional and experimental musical notations. This specification outlines the design principles, supported features, and detailed usage guidelines.

## Supported Formats

The transpiler supports a variety of musical notation formats, ensuring flexibility and interoperability:

### MusicXML

- **Description**: A detailed standard for Western musical notation.
- **Strengths**: Articulations, dynamics, and notation details.
- **Limitations**: Verbosity and parsing complexity.

### MuseScore JSON

- **Description**: A lightweight, human-readable format from MuseScore.
- **Strengths**: Compact and extensible.
- **Limitations**: Limited adoption compared to MusicXML.

### MIDI

- **Description**: A performance-focused standard capturing note data.
- **Strengths**: Universal compatibility with DAWs.
- **Limitations**: Lacks detailed notation information.

---

## Modular Design Principles

### Separation of Concerns

The transpiler leverages a modular architecture, separating instrument definitions, behaviors, and core processing logic into distinct layers. This design ensures clarity, flexibility, and ease of maintenance.

#### Instrument Definitions (.instrument Files)

- Define core properties of instruments, such as tuning, range, and MPE parameters.
- **Example**:
  ```json
  {
    "name": "Violin",
    "type": "string",
    "tuning": ["G3", "D4", "A4", "E5"],
    "range": {"lowest": "G3", "highest": "A7"}
  }
  ```

#### Behavioral Logic (.logic Files)

- Specify complex transformations and performance behaviors declaratively.
- **Example**:
  ```json
  {
    "behaviors": {
      "Arpeggio": {
        "repeat": {
          "frequency": "16n",
          "pattern": {
            "mpe_parameters": {
              "pitch_bend": {
                "channel": 1,
                "values": [0, 2, 4, 2]
              }
            }
          }
        }
      }
    }
  }
  ```

---

## Core Features

### Multi-Track and Layered Support

- **Description**: Synchronize and manage multiple tracks, each with independent properties.
- **Example**:
  ```json
  {
    "timeline": {
      "layers": [
        {
          "id": "violin",
          "instrument": "violin",
          "playstyle": "legato",
          "notes": [
            {"pitch": "A4", "start": "1.1.0", "duration": "1.0.0"}
          ]
        }
      ]
    }
  }
  ```

### Playstyles

Playstyles modify playback interpretation globally, per layer, or per note.

#### Precedence

1. **Note-Level**: Overrides all other settings.
2. **Layer-Level**: Applies to all notes unless overridden.
3. **Global**: Default setting for all layers and notes.

#### Example: Playstyle Hierarchy

```json
{
  "timeline": {
    "globalPlaystyle": "orchestral",
    "layers": [
      {
        "id": "piano",
        "playstyle": "staccato",
        "notes": [
          {"pitch": "C4", "playstyle": "legato"}
        ]
      }
    ]
  }
}
```

### Advanced Use Case: Command-Line Integration

- **Scenario**: Assign instruments, tunings, and playstyles to layers.
- **Command**:
  ```bash
  crunchy --input score.musicxml --output score.mid           --global-playstyle="orchestral"           --layers "layer1:instrument=violin,tuning=G3-D4-A4-E5,playstyle=expressive"           --layers "layer2:instrument=piano,playstyle=staccato"           --layers "layer3:instrument=flute,tuning=C4-E4-G4-A4,playstyle=legato"
  ```

### Error Handling

#### Principles

- **Clarity**: Messages framed in musician-friendly terms.
- **Actionability**: Provide clear resolution steps.

#### Example Errors

- **Structural Error**:
  ```
  "Measure structure issue in Bar 23:
  - Missing time signature after tempo change.
  Suggestion: Add a time signature at the start of measure 23."
  ```
- **Track Relationship Error**:
  ```
  "Track synchronization issue:
  - Violin ends at measure 45; Piano ends at measure 43.
  Suggestion: Align all tracks to the same length."
  ```

---

## Testing and Validation

### Strategy

1. **Unit Tests**: Validate core functionality of each module.
2. **Integration Tests**: Ensure compatibility across modules.
3. **Edge Cases**: Address scenarios like microtonal systems and hybrid instruments.

---

## Version History

- **0.1.5**:
  - Introduced advanced use cases for command-line workflows.
  - Aligned structure and examples with the modular model specification.
  - Enhanced multi-track support with playstyle hierarchy.

---

## Acknowledgments

This document reflects collaborative input from Gene The Machine, Rich Fantasia, and Rachel M. Their expertise continues to shape the evolution of the Crunchy Transpiler.
