str = 'test test test test'

# check in str
s1 = 'test'
if s1 in str:
    print('Yes')

## get by index
print(str[0]) # t
print(str[-1]) # s
# get substr
# from 2 to 4
print(str[2:4]) # st
# from start to 4
print(str[:4]) # st

l = ['a', 'b', 'c']
# join list to string
print(''.join(l)) # abc
print(' '.join(l)) # a b c

s = 'Hello, world!'
# split string to list
print(s.split()) # ['Hello,', 'world!']
print(s.split('l')) # ['He', '', 'o, wor', 'd!']
print(s.split('l', 1)) # ['He', 'lo, world!']

# partition
print(s.partition(' ')) # ('Hello,', ' ', 'world!')

# strip
s = '  test  '
print(s.strip()) # test
s = '***test***'
print(s.strip('*')) # test

# find
s = '** some **'
print(s.find('*')) # 0
print(s.rfind('*')) # 9
# index the same as find but raise exception if not found
print(s.index('*')) # 0
print(s.rindex('*')) # 9

# replace
s = 'test test test'
print(s.replace('test', 'new')) # new new new
print(s.replace('test', 'new', 2)) # new new test

# count
s = 'test test test'
print(s.count('test')) # 3

# sort
s = 'test'
print(sorted(s)) # ['e', 's', 't', 't']
print(sorted(s, reverse=True)) # ['t', 't', 's', 'e']

# ord
print(ord('a')) # 97

# chr
print(chr(97)) # a
