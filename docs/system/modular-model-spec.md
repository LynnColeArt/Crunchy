# Musical Model Format: Interface-Based Specification (DRAFT)

## Core Philosophy
The model uses interfaces to provide clean separation of concerns, allowing musical elements to implement only the characteristics they need.

## Core Interfaces

### Basic Musical Element
```go
type Musical interface {
    // Core timing - required for all musical elements
    Timing() Time
    Duration() Duration
}

// All musical elements must implement Musical
type Time struct {
    Parts    int64    // High-precision position
    Measure  int      // Current measure
}

type Duration struct {
    Parts    int64    // Length in time parts
}
```

### Physical Properties
```go
type Physical interface {
    // Power and energy characteristics
    Power() PowerProfile
    Resonance() []Resonance
}

type PowerProfile struct {
    Initial  float64
    Changes  []PowerChange
}

type Resonance struct {
    Frequency  float64
    Strength   float64
    Decay      float64
}
```

### Feedback Characteristics
```go
type Feedback interface {
    Sources() []FeedbackSource
    Responses() []FeedbackResponse
}

type FeedbackSource struct {
    Type      FeedbackType
    Strength  float64
    Direction Vector
}

type FeedbackResponse struct {
    To        Musical
    Intensity float64
    Decay     float64
}
```

### Temporal Effects
```go
type Temporal interface {
    Delays() []Delay
    Echoes() []Echo
}

type Delay struct {
    Time     Duration
    Feedback float64
}

type Echo struct {
    Spacing  Duration
    Repeats  int
    Decay    float64
}
```

### Pitch and Frequency
```go
type Pitched interface {
    Frequency() Frequency
    Tuning() Tuning
}

type Frequency struct {
    Base    float64   // Base frequency in Hz
    Offset  float64   // Microtonal adjustment
}

type Tuning struct {
    System  TuningSystem
    Root    Frequency
}
```

## Musical Elements

### Basic Note
```go
type Note struct {
    pitch    Pitch
    timing   Time
    duration Duration

    // Optional characteristics
    physical   *PhysicalProperties  // For instruments needing physics
    feedback   *FeedbackProperties  // For feedback-capable elements
    temporal   *TemporalProperties  // For time-based effects
}

// Implements Musical interface
func (n *Note) Timing() Time     { return n.timing }
func (n *Note) Duration() Duration { return n.duration }

// Optionally implements other interfaces based on properties
func (n *Note) Power() PowerProfile {
    if n.physical == nil {
        return PowerProfile{}
    }
    return n.physical.Power()
}
```

### Chord Structure
```go
type Chord struct {
    notes    []Note
    timing   Time
    duration Duration
    
    // Optional group characteristics
    voicing    *VoicingProperties
    harmony    *HarmonicProperties
}
```

## Extension Mechanisms

### Custom Properties
```go
type PropertyCarrier interface {
    Properties() Properties
    SetProperty(key string, value interface{}) error
}

type Properties struct {
    data map[string]interface{}
}
```

### Instrument-Specific Traits
```go
type StringInstrument interface {
    Physical
    StringTension() float64
    BowPressure() float64
}

type WindInstrument interface {
    Physical
    BreathPressure() float64
    ReedResponse() float64
}
```

## Real-World Examples

### Piano Note with Physics
```go
pianoNote := &Note{
    pitch:    NewPitch(440.0), // A4
    timing:   Time{Parts: 0},
    duration: Duration{Parts: 960},
    physical: &PhysicalProperties{
        hammer_velocity: 0.7,
        string_tension: 120.0,
        damper_position: 1.0,
    },
}
```

### Electric Guitar with Feedback
```go
guitarNote := &Note{
    pitch:    NewPitch(196.0), // G3
    timing:   Time{Parts: 1920},
    duration: Duration{Parts: 1920},
    physical: &PhysicalProperties{
        string_tension: 100.0,
    },
    feedback: &FeedbackProperties{
        sources: []FeedbackSource{
            {Type: Amplifier, Strength: 0.8},
        },
    },
}
```

## Benefits of This Approach

### 1. Modularity
- Elements only carry needed properties
- Clean interface separation
- Easy to extend
- Type-safe implementations

### 2. Flexibility
- Supports diverse instruments
- Handles complex effects
- Extensible for new properties
- Future-proof design

### 3. Performance
- No unnecessary data
- Efficient memory use
- Clear optimization paths
- Scalable structure

### 4. Maintainability
- Clear boundaries
- Easy to test
- Simple to debug
- Well-organized code

This interface-based approach provides a robust foundation while maintaining the flexibility to represent complex musical scenarios and characteristics.
