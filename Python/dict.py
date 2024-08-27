if __name__ == '__main__':
 
    dicts = [
        {"lang": "Java", "version": "14"},
        {"lang": "Python", "version": "3.8"},
        {"lang": "C++", "version": "17"},
    ]
 
    key = "lang"
    val = "Python"
 
    d = next((d for d in dicts if d.get(key) == val), None)
    print(d)        # {'lang': 'Python', 'version': '3.8'}
