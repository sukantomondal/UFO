# Solution: sukantomondal

**Date:** June 27, 2019

## Summary

The solution is given as a dockerize application. The application is develodped using PHP Slim Framework and MySql Databases. The solution container runs in CENTOS 7.

## Requirements

In order to install and run the application, your OS should have Docker installed and running. Docker host OS must have the port number 8888 open. In order to run the application, simplily checkout the repo and go to solution diretory and then run the "run_app.sh" bash script.

## Usage

1. Pull the repo in your local box

2. Go to solution directory.
```bash
cd interview-exercise-sukantomondal/solution
```
3. Run the run_app.sh bash script. (It takes a while, so please don't worry, it is building a docker image!!)
```bash
sudo sh run_app.sh
```
Important: The "run_app.sh" script must run in solution directory. The "run_app.sh" script will create a docker image named as "ufoapp" and susequently it will run a container named as "ufo" from the image. So please make sure in your system there is already no container running named as "ufo" that causes the script to fail to run the application.

Ah, still have problems in running the app. Please contact at mondalda@gmail.com 

## Answers

1) How many sightings are there?

```bash
time curl -X GET 'http://localhost:8888/ufo/sightings/count' | jq
{
  "count": 80332
}

real	0m0.081s
user	0m0.046s
sys	0m0.024s

```

2) How many different ships will be attacking?

```bash
time curl -X GET 'http://localhost:8888/ufo/types/count' | jq
{
  "count": 28
}

real	0m0.115s
user	0m0.039s
sys	0m0.033s

```

3) What are the Top-10 cities in the United States that should be evacuated first?

```bash
time curl -X GET 'http://localhost:8888/ufo/attack/evacuation/priorities?country=us' | jq
{
  "sightings": [
    {
      "city": "seattle",
      "count": 524
    },
    {
      "city": "phoenix",
      "count": 454
    },
    {
      "city": "portland",
      "count": 373
    },
    {
      "city": "las vegas",
      "count": 367
    },
    {
      "city": "los angeles",
      "count": 352
    },
    {
      "city": "san diego",
      "count": 338
    },
    {
      "city": "houston",
      "count": 297
    },
    {
      "city": "chicago",
      "count": 264
    },
    {
      "city": "tucson",
      "count": 241
    },
    {
      "city": "miami",
      "count": 239
    }
  ]
}

real	0m0.147s
user	0m0.032s
sys	0m0.045s

```

4) If our secret Area-52 base was to be attacked, where would it come from?

Note: Since the output is huge the acutual json output can be found in q3_answer_output.json

```bash
time curl -X GET 'http://localhost:8888/ufo/sightings/distances' | jq

{
    "sightings": [
        {
            "city": "marquette",
            "country": "us",
            "description": "Light object in sky dims then moves away towards downtown after hovering for several minutes.",
            "distance": 0.45,
            "duration_seconds": 240,
            "duration_text": "4 min",
            "id": 10267,
            "latitude": 46.5436,
            "longitude": -87.3953,
            "occurred_at": "2011-11-29 03:35:00",
            "reported_on": "2011-12-12 00:00:00",
            "shape": "light",
            "state": "mi"
        },
        {
            "city": "marquette",
            "country": "us",
            "description": "We had no idea what it was and did not speak of it for years.",
            "distance": 0.45,
            "duration_seconds": 300,
            "duration_text": "5 minutes",
            "id": 6084,
            "latitude": 46.5436,
            "longitude": -87.3953,
            "occurred_at": "1974-06-01 00:00:00",
            "reported_on": "2006-02-14 00:00:00",
            "shape": "oval",
            "state": "mi"
        },
        {
            "city": "marquette",
            "country": "us",
            "description": "High altitude&#44 high speed object traveled across the sky before dissapearing behind a cloud.",
            "distance": 0.45,
            "duration_seconds": 20,
            "duration_text": "20 seconds",
            "id": 34716,
            "latitude": 46.5436,
            "longitude": -87.3953,
            "occurred_at": "2000-03-12 13:30:00",
            "reported_on": "2000-03-16 00:00:00",
            "shape": "oval",
            "state": "mi"
        },
        {
            "city": "marquette",
            "country": "us",
            "description": "Something awakened me. When I looked out of the deck window at around 4:00 a.m.&#44 I was surprised to see a red flashing light. I live",
            "distance": 0.45,
            "duration_seconds": 900,
            "duration_text": "15 minutes",
            "id": 14024,
            "latitude": 46.5436,
            "longitude": -87.3953,
            "occurred_at": "2008-07-31 16:00:00",
            "reported_on": "2008-08-12 00:00:00",
            "shape": "sphere",
            "state": "mi"
        },
        {
            "city": "marquette",
            "country": "us",
            "description": "Triangular UFO over marquette michigan",
            "distance": 0.45,
            "duration_seconds": 6,
            "duration_text": "about 6 seconds",
            "id": 74802,
            "latitude": 46.5436,
            "longitude": -87.3953,
            "occurred_at": "2010-04-16 01:00:00",
            "reported_on": "2010-05-12 00:00:00",
            "shape": "triangle",
            "state": "mi"
        },
        ...
        ...
        ...
        {
            "city": "darwin (nt&#44 australia)",
            "country": "au",
            "description": "golden orbs travelling in a line.",
            "distance": 14806.61,
            "duration_seconds": 300,
            "duration_text": "5 mins",
            "id": 24668,
            "latitude": -12.4572,
            "longitude": 130.837,
            "occurred_at": "2000-06-15 21:30:00",
            "reported_on": "2001-02-18 00:00:00",
            "shape": "other",
            "state": "nt"
        },
        {
            "city": "melbourne (australia)",
            "country": "au",
            "description": "12/30/05 silver object  hovering for 15 mins",
            "distance": 15675.21,
            "duration_seconds": 900,
            "duration_text": "15 minutes",
            "id": 6148,
            "latitude": -37.8139,
            "longitude": 144.963,
            "occurred_at": "2005-12-30 13:25:00",
            "reported_on": "2006-02-14 00:00:00",
            "shape": "disk",
            "state": "al"
        },
        {
            "city": "adelaide  (south australia)",
            "country": "au",
            "description": "White UFO&#39s over my house&#33&#33",
            "distance": 15993.55,
            "duration_seconds": 300,
            "duration_text": "5 min",
            "id": 17132,
            "latitude": -34.9287,
            "longitude": 138.599,
            "occurred_at": "2006-07-20 14:00:00",
            "reported_on": "2009-12-12 00:00:00",
            "shape": "circle",
            "state": "sa"
        },
        {
            "city": "adelaide  (south australia)",
            "country": "au",
            "description": "A set of 5-7 unknown lights flash over the city of adelaide&#44 australia.",
            "distance": 15993.55,
            "duration_seconds": 180,
            "duration_text": "3mins",
            "id": 64451,
            "latitude": -34.9287,
            "longitude": 138.599,
            "occurred_at": "2008-09-27 00:30:00",
            "reported_on": "2008-10-31 00:00:00",
            "shape": "light",
            "state": "oh"
        },
        {
            "city": "port adelaide (south australia)",
            "country": "au",
            "description": "I was driving down the street&#44 a main road&#44 and looked up and saw a green light flash over my head and qwondered what the hell was that",
            "distance": 15998.86,
            "duration_seconds": 5,
            "duration_text": "5 sec",
            "id": 16713,
            "latitude": -34.85,
            "longitude": 138.467,
            "occurred_at": "1996-09-14 23:30:00",
            "reported_on": "1999-12-16 00:00:00",
            "shape": "light",
            "state": "sa"
        },
        {
            "city": "cue (western australia) (australia)",
            "country": "au",
            "description": "Bright flashing moving light stops moving then loops.",
            "distance": 16946.53,
            "duration_seconds": 30,
            "duration_text": "30 seconds",
            "id": 67941,
            "latitude": -27.424,
            "longitude": 117.897,
            "occurred_at": "2013-10-03 22:00:00",
            "reported_on": "2013-10-14 00:00:00",
            "shape": "light",
            "state": "wa"
        },
        {
            "city": "perth (western australia)",
            "country": "au",
            "description": "Large rectangular object with large lights on the bottom at each point very faintly illuminating dark interior.  Silent slow moving and",
            "distance": 17453.64,
            "duration_seconds": 420,
            "duration_text": "7 minutes",
            "id": 29231,
            "latitude": -31.9522,
            "longitude": 115.861,
            "occurred_at": "2014-03-16 01:00:00",
            "reported_on": "2014-03-21 00:00:00",
            "shape": "rectangle",
            "state": "wa"
        }
    ]
}

real	0m14.105s
user	0m3.510s
sys	0m2.598s

```

## Ambiguity Notes

N/A: I liked the problems and enjoyed in implementing the solutions. Thanks!!! :)
