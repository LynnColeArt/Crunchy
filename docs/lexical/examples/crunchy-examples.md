# CRUNCHY Format Examples

## Simple Pop Song Example

### pop-chorus.crhy
```javascript
section verse {
    chord: [C, G, Am, F],
    rhythm: /X.x.X.x./,
    repeat: 4,
    dynamics: crescendo(0.3)
}
```

### pop-chorus.crnch
```
v{c[CGAF]r"X.x.X.x."n4d(0.3)}
```

## Jazz Voicing Example

### jazz-voicing.crhy
```javascript
voicing jazz_chord {
    root: Cmaj7,
    extensions: [9, 13],
    spread: [3,7,9,13],
    voice_leading: smooth,
    style: rootless
}
```

### jazz-voicing.crnch
```
vj{rCM7x[9,13]s[3793]ls}
```

## Lyrical Pattern Example

### verse-pattern.crhy
```javascript
pattern verse_1 {
    lyrics: "Dancing in the moonlight" {
        stress: [1,0,0,1,0,1],
        syl: [2,1,1,1,1],
        align: /X.x.X.x.|X.x./
    },
    melody: {
        base: [C4,E4,G4],
        contour: arc(rise)
    }
}
```

### verse-pattern.crnch
```
p1{l"DitM"{s[100101]y[21111]a"X.x.X.x.|X.x."}m{b[C4E4G4]cr}}
```

[Continue with other examples but with clear filenames...]
