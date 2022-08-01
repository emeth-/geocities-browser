View live at: [https://randomgeo.city](https://randomgeo.city).

A year or so ago I created this geocities_clean.csv file.

Here is what I remember from how I generated it:

- Start with archive.org's [ALL-GEO-SEEDS-20090730.txt](https://archive.org/download/webcrawl-geocities-seedlist), which contained (iirc) around 42 million rows of URLS
- Attempt to reduce the list to just a single root URL per geocities user (e.g. if there was example.com/bob/ and example.com/bob/pic.jpg, we keep the shortest url only - example.com/bob/), I believe the result was around ~2 million rows
- Run a spider to gather all page titles from remaining URLs.
- Delete all URLs that have page titles SOLELY made up of non-ascii characters (this mostly got rid of Chinese sites), as my audience was English
- Delete all URLs that have page titles with genitals/cam girl in the name.
- Delete all URLs that have page titles with Malware/Virus/etc in the name.
- Result is geocities_clean.csv, around 1,477,689 unique websites ALONG WITH their page titles.

This was created for an unrelated project, but for the last several months I've found myself randomly loading websites from it just for fun, and often stumbling on fascinating things (Animorph/Pokemon fan fiction, personal stories about September 11th, lots of Goth stuff, Bands, and lots of just personal 'About Me' pages with random people's stories).

Thought it was worth throwing up on a webserver and sharing.

Feel free to use the data to build your own project - consider it under the public domain (or whatever archive.org released their dataset under if that's more restrictive).