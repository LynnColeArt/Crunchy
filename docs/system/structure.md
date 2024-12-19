# Proposed Project Structure

```crunchy/
├── cli/crunchy/           
│   ├── main.go            # Entry point
│   ├── main_test.go       # CLI tests
│   ├── commands/          # Command implementations
│   │   ├── convert.go
│   │   ├── convert_test.go
│   │   ├── validate.go
│   │   └── validate_test.go
│   └── config/           # CLI configuration
│       ├── config.go
│       └── config_test.go
├── internal/
│   ├── model/            # Core data model
│   │   ├── score.go
│   │   ├── score_test.go
│   │   ├── track.go
│   │   ├── track_test.go
│   │   ├── serialize.go
│   │   └── serialize_test.go
│   ├── formats/          # Format handlers
│   │   ├── format_test.go
│   │   ├── musicxml/
│   │   │   ├── convert.go
│   │   │   └── convert_test.go
│   │   ├── musescore/
│   │   │   ├── convert.go
│   │   │   └── convert_test.go
│   │   └── midi/
│   │       ├── convert.go
│   │       └── convert_test.go
│   ├── engine/           # Core logic
│   │   ├── parser.go
│   │   ├── parser_test.go
│   │   ├── converter.go
│   │   ├── converter_test.go
│   │   ├── validator.go
│   │   ├── validator_test.go
│   │   └── testdata/    # Test fixtures
│   └── util/            # Shared utilities
│       ├── errors/
│       │   ├── errors.go
│       │   └── errors_test.go
│       └── logger/
│           ├── logger.go
│           └── logger_test.go
├── test/                # Integration/E2E tests
│   ├── integration/
│   └── fixtures/
├── pkg/model/          # Public model API
│   ├── model.go
│   └── model_test.go
├── docs/              # Documentation
│   ├── formats/
│   └── spec/
└── examples/          # Usage examples
```