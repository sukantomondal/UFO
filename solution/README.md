# Solution: {github-username}

**Date:** {date-completed}

## Summary

{Add a summary here describing the overall solution in your own words.}

## Requirements

{Add breakdown of requirements necessary to run your solution}

## Usage

{Add breakdown of usage, e.g. how do you run the HTTP service?}

## Answers

For each answer, copy/paste the execution of a simple `curl` command against your HTTP service and with its output
and time execution.

#### Example

An example section for Question #1 could be imagined as:

---

1) How many different ships will be attacking?
```bash
⇒  time curl http://localhost:5000/ufo/sightings/count
{
  "count": 80332
}
curl http://localhost:5000/ufo/sightings/count  0.01s user 0.01s system 14% cpu 0.120 total
```

---

1) How many sightings are there?

```bash
{Add command output here}
```

2) How many different ships will be attacking?

```bash
{Add command output here}
```

3) What are the Top-10 cities in the United States that should be evacuated first?

```bash
{Add command output here}
```

4) If our secret Area-52 base was to be attacked, where would it come from?

```bash
{Add command output here}
```

## Ambiguity Notes

{Add notes here if you were unsure about any questions and what specific implementation choices were made.}
