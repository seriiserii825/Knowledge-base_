x = tuple('hello')
print(x) # ('h', 'e', 'l', 'l', 'o')

# упаковка
x, y, z = (1, 2, 3)

# распаковка
x, y, z = (1, 2, 3)
print(x) # 1
print(y) # 2
print(z) # 3


x, y, z, *t = 1, 2, 3, 8, 9
print(x) # 1
print(y) # 2
print(t) # [8, 9]
