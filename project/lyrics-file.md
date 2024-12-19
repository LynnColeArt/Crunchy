```javascript
require('./config/constants');
require('./lib/transforms');

const VOCAL_STYLE = IS_LIVE ? "projected" : "intimate";

lyrics {
    // Common stress patterns we'll reuse
    patterns: {
        verse_meter: [1,0,1,0,1,0,1],  // Common country meter
        power_line: [1,1,0,1,0,0,1],   // For emphatic phrases
        gentle_end: [0,1,0,1,0]        // Soft ending pattern
    },

    verse_1: {
        lines: [
            "My cat's got claws of iron",
            "Eyes that pierce the night",
            "She stalks the farm at midnight",
            "Queen of the moonlight"
        ],
        stress: [
            patterns.verse_meter,
            patterns.gentle_end,
            patterns.verse_meter,
            patterns.gentle_end
        ],
        delivery: VOCAL_STYLE,
        dynamics: crescendo(0.1)
    },

    chorus: {
        lines: [
            "She's the queen of the barnyard",
            "The terror of the field",
            "My little ball of fury",
            "With whiskers made of steel"
        ],
        stress: [
            patterns.power_line,
            patterns.gentle_end,
            patterns.verse_meter,
            patterns.power_line
        ],
        delivery: IS_LIVE ? "belt" : VOCAL_STYLE,
        dynamics: forte
    },

    verse_2: {
        lines: [
            "The mice all know her legend",
            "The dogs all fear her name",
            "She rules her realm with iron paws",
            "No beast she can't tame"
        ],
        stress: verse_1.stress,
        delivery: verse_1.delivery,
        dynamics: crescendo(0.2)
    },

    bridge: {
        lines: [
            "But when the day is ending",
            "And the farm grows still",
            "She's curled up in my lap now",
            "My warrior, my will"
        ],
        stress: [
            patterns.verse_meter,
            patterns.gentle_end,
            patterns.verse_meter,
            [1,1,0,1]  // Strong ending
        ],
        delivery: "intimate",
        dynamics: transform({
            start: mezzo_piano,
            end: forte,
            curve: "exponential"
        })
    },

    // Performance adaptations
    when(PERFORMANCE_TYPE === "acoustic") {
        adjust_delivery("intimate");
        reduce_dynamics(0.2);
    }

    when(IS_LIVE) {
        add_crowd_interaction({
            after: "queen of the barnyard",
            expect: "response_time(2)"
        });
    }
}

// Export with metadata
export default lyrics with {
    key: "Dm",
    tempo_range: [85, 95],
    melodic_range: ["C4", "D5"],
    time_signature: "4/4"
};
```
