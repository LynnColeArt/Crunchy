
# Bridging The Gap: A Modular and Extensible Specification for Contextual Representation in Musical Notation Modeling

**Draft Specification 0.3.1**

## Overview

A modular framework for encoding musical information in JSON format, designed to capture both traditional notation and performance data while maintaining format independence. This system is targeted at mid-level developers, senior developers, and technically minded musicians who are comfortable working with structured data.

---

## Core Structure

### Base Score Format

The base score defines the metadata, structure, and parts of the musical composition.

```json
{
  "score": {
    "metadata": {
      "title": "Example Score",
      "tickResolution": 960,
      "initialTempo": 120,
      "initialTimeSignature": {
        "numerator": 4,
        "denominator": 4
      }
    },
    "structure": [
      {
        "section": "verse",
        "startMeasure": 1,
        "endMeasure": 4,
        "lyrics": [
          {
            "text": "First verse line",
            "timing": {"measure": 1, "parts": 0}
          }
        ]
      },
      {
        "section": "chorus",
        "startMeasure": 5,
        "endMeasure": 8
      }
    ],
    "parts": []
  }
}
```

---

## Instrument Definitions

### Modular Instruments

Instruments define the sound source for a musical part. They are modular, allowing variations such as tuning, range, and timbre to be specified dynamically. Each instrument is pre-processed into its own structured file for efficient compilation and runtime use. These files already include validated data for tuning, range, and associated rules.

#### Example: Bass Guitar

```json
{
  "name": "Bass Guitar",
  "type": "string.bass",
  "variations": [
    {
      "id": "fiveStringBass",
      "additionalStrings": ["B1"],
      "extendedRange": ["B1", "G3"],
      "defaultTimbre": "deep"
    }
  ],
  "rules": {
    "tuningRules": {
      "regex": "^[EADGB][#b]?[1-6]$",
      "errorMessage": "Invalid tuning."
    },
    "rangeRules": {
      "regex": "^[CDEFGAB][#b]?[2-4]$",
      "action": "allow"
    }
  }
}
```

---

## Modifiers and Effects

Modifiers and effects dynamically alter an instrument's behavior or properties during playback. These are defined in JSON and support blending for nuanced transitions.

### Modifiers with Blending

Modifiers include attributes such as pitch, dynamics, or vibrato, which can be blended over time. Blending supports linear or exponential transitions with constraints.

#### Example Modifier

```json
{
  "type": "pitch",
  "value": 2,
  "blend": {
    "type": "linear",
    "duration": "1s",
    "priority": 1
  }
}
```

### Effects

Effects such as reverb or delay are structured similarly to modifiers but act on the sound output.

#### Example Effect

```json
{
  "type": "reverb",
  "intensity": 0.8,
  "blend": {
    "type": "exponential",
    "duration": "2s"
  }
}
```

---

## Timeline and Layers

### Timeline

The timeline organizes all musical elements, aligning notes, modifiers, and effects to precise points in time.

#### Features:

- **Absolute Positioning:** Based on measures and parts.
- **Layering:** Each track or instrument exists on its own layer, allowing parallel processing.
- **Blending and Transitions:** Smooth transitions between effects and modifiers.
- **Global Modifiers:** Tempo changes, key changes, and other global effects are applied at the timeline level and synchronized across layers.

#### Example Timeline

```json
{
  "timeline": {
    "layers": [
      {
        "id": "track1",
        "instrument": "piano",
        "notes": [
          {"start": "1.1.0", "duration": "1.0.0", "pitch": "C4"}
        ],
        "effects": [
          {"start": "1.1.0", "end": "2.0.0", "type": "reverb", "intensity": 0.7}
        ]
      },
      {
        "id": "track2",
        "instrument": "violin",
        "notes": [
          {"start": "1.2.0", "duration": "1.0.0", "pitch": "E4"}
        ],
        "modifiers": [
          {"start": "1.1.0", "end": "1.3.0", "type": "vibrato", "depth": 0.3}
        ]
      }
    ],
    "globalEffects": [
      {"type": "tempoChange", "start": "2.1.0", "tempo": 140},
      {"type": "keyChange", "start": "3.1.0", "key": "G Major"}
    ]
  }
}
```

---

## Regular Expression Rules

Regex-based rules allow dynamic validation and modification of instrument behavior. These rules can apply to tuning, ranges, or other parameters.

#### Example

```json
{
  "rules": {
    "tuningRules": {
      "regex": "^[EADGB][#b]?[1-6]$",
      "errorMessage": "Invalid tuning."
    },
    "rangeRules": {
      "regex": "^[CDEFGAB][#b]?[3-5]$",
      "action": "allow"
    }
  }
}
```

---

## End-to-End Example

This example demonstrates a complete musical composition, from metadata to timeline and effects.

```json
{
  "score": {
    "metadata": {
      "title": "Complete Composition",
      "tickResolution": 960,
      "initialTempo": 120,
      "initialTimeSignature": {
        "numerator": 4,
        "denominator": 4
      }
    },
    "structure": [
      {
        "section": "verse",
        "startMeasure": 1,
        "endMeasure": 4
      },
      {
        "section": "chorus",
        "startMeasure": 5,
        "endMeasure": 8
      }
    ],
    "timeline": {
      "layers": [
        {
          "id": "track1",
          "instrument": "guitar",
          "notes": [
            {"start": "1.1.0", "duration": "1.0.0", "pitch": "C4"}
          ],
          "effects": [
            {"start": "1.1.0", "end": "2.0.0", "type": "reverb", "intensity": 0.7}
          ]
        }
      ],
      "globalEffects": [
        {"type": "tempoChange", "start": "3.1.0", "tempo": 140}
      ]
    }
  }
}
```

---

## Future Considerations

### Enhancements

1. **Custom Programming Layer:** Design for contextually aware music, introducing conditional logic and programmatic control over musical constructs.

---

## Acknowledgments

This specification has benefited from valuable feedback and contributions from Tim Simpson Jr., Michael Davis, Rich Fantasia, Gene The Machine, and Rachel M.

---

This is a conversation, not a monologue. Your input and technical insights are valued. We need everybody to make this work.
