# Crunchy Project Extended Context

## Core Understanding
- Music notation transpiler is foundation for larger vision
- Multiple validated formats need reliable conversion
- Multi-track support is essential from start
- Error handling must speak musicians' language

## Technical State
1. Architecture Defined
   - Hybrid event-graph structure chosen
   - Multi-track support designed
   - Clear parsing/conversion pipeline
   - Error handling strategy established

2. Current File Structure
   - MIDI utilities implemented
   - Basic parser framework exists
   - CLI infrastructure in place
   - Logging system ready

3. Known Issues
   - Build errors in CLIConfig
   - Duplicate code between translators
   - Need to consolidate translation logic

## Critical Design Decisions
1. Data Representation
   - Event-based timing
   - Graph-like relationships
   - Flexible property system
   - Track-aware structure

2. Error Strategy
   - Musical terminology over technical
   - Clear location information
   - Actionable suggestions
   - Structured for future expansion

3. Implementation Priorities
   - Clean conversion pipeline
   - Robust multi-track handling
   - Comprehensive testing
   - Clear error reporting

## Development Context
1. Build/Test Status
   - Some link errors present
   - Basic framework compiles
   - Need test infrastructure
   - Ready for core implementation

2. Next Implementation Tasks
   - Fix build issues
   - Consolidate translators
   - Implement basic parsers
   - Create test framework

## Future-Proofing Considerations
- Internal representation supports future DNA format
- Architecture allows for state awareness later
- Design permits musical programming extensions
- Error system expandable for future features

## Community Aspects
- Project generating interest
- Multiple stakeholder groups:
  - Musicians
  - Developers
  - AI researchers
- Open to constructive critique
- Focus on practical utility

## Current Boundaries
What's In Scope:
- Format conversion
- Multi-track support
- Error handling
- Basic validation
- Core testing

What's Out of Scope (For Now):
- DNA format implementation
- Programming language features
- State management
- Version control
- UI/UX considerations

## Key Principles
1. Technical
   - Separation of concerns
   - Clean code practices
   - Test-driven development
   - Modular design

2. Strategic
   - "Finesse over brute force"
   - Perfect execution over feature creep
   - Clear, focused goals
   - Sustainable development pace

3. Communication
   - Clear documentation
   - Musical terminology in errors
   - Open to feedback
   - Regular validation

## File Overview
1. Core Files
   - midi_utils.h/cpp
   - music_notation_translator.h/cpp
   - translator.h/cpp
   - cli_config.h/cpp

2. Support Files
   - logger.h/cpp
   - file_handler.h/cpp

3. Documentation
   - Design document
   - Error handling spec
   - DNA specification (future)

## Critical Path
1. Immediate
   - Fix build issues
   - Consolidate duplicate code
   - Basic parser implementation
   - Test framework setup

2. Short Term
   - Complete format parsers
   - Implement converters
   - Error handling system
   - Basic validation

3. Validation Goals
   - Clean conversion between formats
   - Proper multi-track handling
   - Clear error messages
   - Test coverage

## Collaboration Notes
- Hobby project pace
- Focus on quality over speed
- Open to creative solutions
- Maintain scope discipline

## Remember
- Build foundation first
- Keep scope focused
- Test thoroughly
- Document clearly
- Stay precise

## Notable Quotes
"The biggest killer of software projects is these words, 'Wouldn't it be nice if...' followed by anything."
"It's how you change the world. Everybody expects you to be swinging sledgehammers around... We've decided to play with swords instead. It's much more precise."

This context should help maintain continuity and focus as development progresses.
