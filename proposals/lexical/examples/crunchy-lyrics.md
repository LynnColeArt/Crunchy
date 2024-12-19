# Complex Lyrical Pattern Example

## bad-days-chorus.crhy
```javascript
section chorus {
    mood: tender -> intense -> tender,
    flow: continuous with {micro_pauses},
    
    lyrics: [
        "I wish you'd let me be there",
        "On your bad days"
    ] {
        stress: [
            [0,1,0,1,0,1,0],
            [1,0,1,1]
        ],
        syl: [
            [1,1,1,1,1,1,0],
            [1,1,1,1]
        ],
        align: [
            /X.x.X.x.|X.x./,
            /X.x.X_/
        ],
        emotion: yearning
    },

    lyrics: [
        "I'm falling for you in the best ways",
        "I've got no regrets then",
        "Laugh with you when"
    ] {
        stress: cascade([
            [1,1,0,1,0,0,1,1],
            [1,1,0,1,1],
            [1,0,0,1]
        ]),
        flow: cascade(0.25),
        emotion: rising_intensity
    },

    melody: {
        contour: arc(high -> low -> high),
        range: [C4, G5],
        accent_points: [
            "best ways" -> lift(minor_third),
            "sideways" -> slide(down),
            "lullaby" -> resolve(tonic)
        ]
    }
}
```

## bad-days-chorus.crnch
```
c{m[t>i>t]f[c,mp]l[["Iwylmbt","Oybd"]{s[[0101010][1011]]y[[1111110][1111]]a["X.x.X.x.|X.x.","X.x.X_"]ey}]["Iffyitbw","Ignrt","Lyw"]{sc[[11010011][11011][1001]]f.25er}]m{ch>l>h,r[C4G5]ap[bw>l3,sw>sd,ll>rt]}}
```

Notice how the emotional and lyrical complexity is preserved in the crunched version while removing all unnecessary space and using minimal identifiers. Want me to break down how specific parts got compressed?