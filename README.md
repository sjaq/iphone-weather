## Installation
For US people just change `[LOCATION]` into you ZIP code and change `[DEGREE]` to `f` for farenheit
Other people go to [Yahoo Weather](http://weather.yahoo.com/) and search for your location you will end up with a url like this: `http://weather.yahoo.com/forecast/NLXX0018.html` then you should change `[LOCATION]` into `NLXX0018`. Then you'll have to change `[DEGREE]` to your degree system, use `c` for celcius and `f` for farenheit.

Then just place the Wallpaper.html file in your current Theme directory..

## Refresh rate
You can append `&refresh=[TIMEINSECONDS]` to the frame src to change the refresh rate, the default and minimum is 30 minutes. If you refresh faster you will see no difference because degrees are cached and updated only once every half hour.

## Custom styles:
Just append `&style=http://location.to.your/style.css` to the frame src and it will load that style, you have to style #weather p..

To only change the font append &font=FontName to the frame src

## Known Issues
If you're getting a "ur doin somthn wrng" message check your location and degree type again. I've seen people filling in XXXXXX_c or something like that as their location you need to remove the "_c" part and try again. And your location should only contain your location ID not the entire http://weather.yahoo.com url.

### Some location examples:
`http://weather.yahoo.com/forecast/NLXX0018_c.html -> ?loc=NLXX0018&deg=c`
`http://weather.yahoo.com/forecast/USCA0087.html -> ?loc=USCA0087&deg=f`