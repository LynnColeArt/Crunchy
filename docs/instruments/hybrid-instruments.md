# Revised Hybrid Instrument Examples

## Fiddarmonica

### fiddarmonica.instrument
```json
{
  "name": "Fiddarmonica",
  "type": "hybrid.wind.string",
  "components": {
    "harmonica": {
      "type": "wind",
      "range": ["C4", "C6"],
      "mpe_parameters": {
        "breath": {
          "channel": 2,
          "cc": 74
        },
        "pressure": {
          "channel": 2,
          "cc": 73
        }
      }
    },
    "strings": {
      "type": "string",
      "tuning": ["G3", "D4", "A4", "E5"],
      "mpe_parameters": {
        "bow_pressure": {
          "channel": 3,
          "cc": 74
        },
        "bow_position": {
          "channel": 3,
          "cc": 75
        },
        "vibrato": {
          "channel": 3,
          "cc": 76
        }
      }
    }
  }
}
```

### fiddarmonica.logic
```json
{
  "behaviors": {
    "BlowWhileBowing": {
      "mpe_parameters": {
        "resonance": {
          "channel": 4,
          "cc": 77,
          "value_range": [60, 120],
          "blend": {
            "inputs": ["breath", "bow_pressure"],
            "curve": "multiplicative"
          }
        }
      }
    },
    "DrawWhileStrumming": {
      "mpe_parameters": {
        "dampen": {
          "channel": 4,
          "cc": 78,
          "value_range": [40, 90]
        },
        "attack": {
          "channel": 2,
          "cc": 73,
          "value_range": [80, 110]
        }
      }
    },
    "SoftBreathingTremolo": {
      "repeat": {
        "frequency": "8n",
        "pattern": {
          "mpe_parameters": {
            "breath": {
              "channel": 2,
              "cc": 74,
              "values": [60, 40, 60, 40]
            },
            "bow_pressure": {
              "channel": 3,
              "cc": 74,
              "values": [40, 60, 40, 60]
            }
          }
        }
      }
    }
  }
}
```

## ChiptarBoard

### chiptarboard.instrument
```json
{
  "name": "ChiptarBoard",
  "type": "hybrid.digital.string",
  "components": {
    "chiptune": {
      "type": "digital.8bit",
      "waveforms": ["square", "triangle", "sawtooth"],
      "mpe_parameters": {
        "waveform_select": {
          "channel": 2,
          "cc": 74
        },
        "pulse_width": {
          "channel": 2,
          "cc": 75
        }
      }
    },
    "strings": {
      "type": "string.electric",
      "tuning": ["E2", "A2", "D3", "G3", "B3", "E4"],
      "mpe_parameters": {
        "pick_position": {
          "channel": 3,
          "cc": 74
        },
        "pick_intensity": {
          "channel": 3,
          "cc": 75
        },
        "string_bend": {
          "channel": 3,
          "cc": 76
        }
      }
    }
  }
}
```

### chiptarboard.logic
```json
{
  "behaviors": {
    "DigitalArpeggio": {
      "repeat": {
        "frequency": "16n",
        "pattern": {
          "mpe_parameters": {
            "waveform_select": {
              "channel": 2,
              "cc": 74,
              "values": [0, 1, 2, 1]
            },
            "pulse_width": {
              "channel": 2,
              "cc": 75,
              "values": [64, 96, 64, 32]
            }
          }
        }
      }
    },
    "StringBitCrush": {
      "conditions": {
        "when": "pick_intensity > 100",
        "apply": {
          "mpe_parameters": {
            "waveform_select": {
              "channel": 2,
              "cc": 74,
              "value": 0
            },
            "pulse_width": {
              "channel": 2,
              "cc": 75,
              "value": 127
            }
          }
        }
      }
    },
    "ChipFeedback": {
      "mpe_parameters": {
        "resonance": {
          "channel": 4,
          "cc": 77,
          "value_range": [80, 127],
          "blend": {
            "inputs": ["pulse_width", "pick_intensity"],
            "curve": "exponential"
          }
        }
      }
    }
  }
}
```

Note that all parameters and behaviors compile down to standard MPE messages, maintaining the "dumb compiler" approach while allowing complex musical expression through declarative patterns and conditions.