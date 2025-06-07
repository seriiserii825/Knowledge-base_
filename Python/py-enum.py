from enum import Enum

class WeatherType(Enum):
    THUNDERSTORM = "Thunderstorm"
    DRIZZLE = "Drizzle"
    RAIN = "Rain"
    SNOW = "Snow"
    CLEAR = "Clear"
    FOG = "Fog"
    CLOUDS = "Clouds"

print(WeatherType.THUNDERSTORM.name)  # Output: THUNDERSTORM
print(WeatherType.THUNDERSTORM.value) # Output: Thunderstorm

for weather in WeatherType:
    print(weather.name, weather.value)

# match WeatherType:
#     case WeatherType.THUNDERSTORM:
#         print("It's a thunderstorm!")
#     case WeatherType.RAIN:
#         print("It's raining!")
#     case _:
#         print("Weather is not thunderstorm or rain.")

def print_weather_type(weather_type: WeatherType):
    print(weather_type.value)

print_weather_type(WeatherType.RAIN)  # Output: Rain
print(isinstance(WeatherType.RAIN, WeatherType))  # Output: True

# without enum ====================

class WeatherClear():
    THUNDERSTORM = "Thunderstorm"
    DRIZZLE = "Drizzle"
    RAIN = "Rain"
    SNOW = "Snow"
    CLEAR = "Clear"
    FOG = "Fog"
    CLOUDS = "Clouds"

print(WeatherClear.THUNDERSTORM)  # Output: THUNDERSTORM
print(WeatherClear.THUNDERSTORM) # Output: Thunderstorm

def print_weather_clear(weather_clear: WeatherClear):
    print(weather_clear)

print_weather_clear(WeatherClear.RAIN) # error: WeatherClear.RAIN is not defined
