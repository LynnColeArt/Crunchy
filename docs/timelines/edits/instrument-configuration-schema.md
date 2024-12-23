## Instrument Configuration Schema

```json
{
  "instrument": {
    "name": "Violin",
    "version": "0.3.4",
    "serialization_config": {
      "compatibility": {
        "musicxml": true,
        "midi": true,
        "musescore": true
      },
      "error_reporting": {
        "level": "comprehensive",
        "format": "json",
        "include_context": true
      }
    },
    "metadata": {
      "family": "string",
      "range": {
        "lowest": "G3",
        "highest": "A7"
      }
    }
  }
}
```

### Schema Components

- **Versioning**: Specific version for instrument definition
- **Compatibility**: Format support tracking
- **Metadata**: Instrument-specific details
- **Error Reporting**: Standardized error handling
