# Crunchy
## A Precision Music Notation Transpiler

> **Project Status**: Crunchy is currently in early design and implementation phases. We are actively developing the core architecture and welcome community input on the design. The project has not yet reached MVP status.

Crunchy is an open-source music notation transpiler designed to provide reliable, accurate conversion between different musical notation formats. With a focus on maintaining musical fidelity and supporting multi-track compositions, Crunchy aims to serve as a robust foundation for music notation processing.

## Overview

Currently in development, Crunchy is being built to convert between various music notation formats while preserving all musical information. It will handle:
- Multiple notation formats (MusicXML, MuseScore JSON, MIDI)
- Multi-track compositions
- Complex musical structures
- Format-specific features

```bash
# Basic usage
crunchy --input score.musicxml --output score.mid

# Multi-file batch processing
crunchy --input ./scores --output ./midi --recursive
```

## Key Features

- **Format Support**
  - MusicXML parsing and generation
  - MuseScore JSON support
  - MIDI file handling
  - Extensible format system

- **Multi-Track Support**
  - Full multi-track preservation
  - Track relationship handling
  - Timing synchronization
  - Track-specific properties

- **Error Handling**
  - Clear, musician-friendly error messages
  - Precise error location reporting
  - Helpful suggestions for resolution
  - Detailed conversion logging

## Building from Source

### Prerequisites
[tbd]

### Build Steps
```bash
mkdir build
cd build
cmake ..
make
```

### Running Tests
```bash
cd build
ctest
```

## Usage Examples

### Basic Conversion
```bash
# Convert MusicXML to MIDI
crunchy -i input.musicxml -o output.mid

# Convert MuseScore JSON to MusicXML
crunchy -i score.json -o score.musicxml
```

### Advanced Options
```bash
# Process directory with specific formats
crunchy --input-dir ./scores --output-dir ./midi \
        --input-format musicxml --output-format midi \
        --recursive

# Verbose conversion with detailed logging
crunchy -i input.musicxml -o output.mid --verbose
```

## Contributing

We welcome contributions! Whether you're a musician, developer, or both, your input is valuable. See our [Contributing Guide](CONTRIBUTING.md) for details.

### Key Areas for Contribution
- Format support expansion
- Performance optimization
- Test case development
- Documentation improvements
- Bug reports and fixes

## Error Handling Examples

Crunchy provides clear, musical context-aware error messages:

```
Track synchronization issue:
- Piano part ends at measure 45
- Violin part ends at measure 43
- All parts must have the same length
```

```
Invalid notation in measure 15, Cello part:
- Found quarter note triplet spanning barline
- Triplets must be contained within a single measure
Suggestion: Split the triplet at the barline
```

## Architecture

Crunchy uses a hybrid event-graph structure for internal representation, combining:
- Event-based timing
- Graph-like relationships
- Flexible property system
- Multi-track awareness

This design ensures accurate conversion while maintaining musical integrity.

## Project Status

Crunchy is under active development. Current focus:
- Core transpiler implementation
- Format parser development
- Test framework establishment
- Error handling system

## License

GNU General Public License v3.0

Crunchy is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.

## Acknowledgments

Crunchy is being developed with input from musicians, developers, and the open-source community. Special thanks to all contributors who help make this project possible.

---

For more detailed information, see our [Documentation](docs/readme.md).
