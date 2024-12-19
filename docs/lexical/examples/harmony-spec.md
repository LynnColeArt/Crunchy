# Multi-Voice Harmony and Counterpoint Specification

## Basic Harmony Stack
```javascript
let harmony_stack = {
    base: melody,
    layers: [
        [0],           // Main melody
        [-3, -7],      // Third and seventh below
        [4, 7],        // Third and fifth above
        [-12, 7, 12]   // Extended voicing
    ].with_weight([
        1.0,    // Melody full strength
        0.7,    // Lower harmonies slightly softer
        0.6,    // Upper harmonies lighter
        0.4     // Extended voicings subtle
    ])
};
```

## Counterpoint Definition
```javascript
let counterpoint = {
    voices: [
        [melody_line,     timing: [1,0,1,0]], 
        [counter_melody,  timing: [0,1,0,1]],
        [bass_line,       timing: [1,1,0,0]]
    ].with_rules({
        max_parallel: 3,      // Avoid too many parallel motions
        contrary_motion: 0.6,  // Prefer contrary motion 60% of time
        voice_crossing: false  // Don't let voices cross
    })
};
```

## Combined Chorus Section
```javascript
section chorus {
    lyrics: ["Main line", "Counter line"] {
        align: interleave([
            /X.x.X.x/,  // Main rhythm pattern
            /x.X.x.X/   // Counter rhythm pattern
        ])
    },
    
    harmony: harmony_stack,
    motion: counterpoint,
    
    transitions: {
        voice_leading: smooth,
        max_interval: perfect_fifth,
        resolution: to_nearest
    }
}
```

## Key Components

### Harmony Stack
- **Base melody**: Core melodic line
- **Layers**: Array of interval offsets from base melody
- **Weights**: Relative volume/prominence of each layer

### Counterpoint Structure
- **Voices**: Array of melodic lines with timing patterns
- **Rules**: Constraints for voice interaction
- **Timing**: Binary patterns for rhythmic interplay

### Voice Leading
- **Smooth transitions**: Minimizes intervallic jumps
- **Maximum intervals**: Limits size of melodic leaps
- **Resolution**: Defines how voices resolve to next section

## Usage Notes

1. Harmony layers are defined relative to the base melody
2. Timing patterns can be customized per voice
3. Rules ensure proper voice leading and counterpoint
4. Transitions handle movement between sections smoothly

## Example Application

This system can be used to create complex vocal arrangements where:
- Multiple voices weave independent melodies
- Harmonies build and reduce dynamically
- Voice leading follows traditional rules
- Rhythmic patterns create interlocking grooves

The structure allows for both traditional and experimental approaches to harmony and counterpoint while maintaining musical coherence.
