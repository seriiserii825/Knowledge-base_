1. Remove Consecutive Duplicate Lines
   echo -e "apple\napple\nbanana\nbanana\ncherry" | uniq

# Output:

- apple
- banana
- cherry

2. Count Occurrences of Each Line
   echo -e "apple\napple\nbanana\ncherry\ncherry" | uniq -c

# Output:

- 2 apple
- 1 banana
- 2 cherry

3. Show Only Unique Lines (No Duplicates)
   echo -e "apple\napple\nbanana\ncherry\ncherry" | uniq -u

- Output:
- banana

4. Show Only Duplicated Lines
   echo -e "apple\napple\nbanana\ncherry\ncherry" | uniq -d

# Output:

- apple
- cherry

5. Ignore Case When Finding Duplicates
   echo -e "Apple\napple\nBanana\nbanana" | uniq -i

# Output:

- Apple
- Banana

6. Skip Fields Before Comparing Lines
   echo -e "1 apple\n2 apple\n3 banana\n4 banana" | uniq --skip-fields=1

# Output:

- 1 apple
- 3 banana

7. Skip Characters Before Comparing
   echo -e "abcapple\nxyzapple\nabcbana\nxyzbana" | uniq --skip-chars=3

# Output:

- abcapple
- abcbana

8. Limit Comparisons to First N Characters
   echo -e "applepie\napplejuice\nbananapie\nbananajuice" | uniq --check-chars=5

# Output:

- applepie
- bananapie

9. Output Duplicates with Delimiters
   echo -e "apple\napple\nbanana\ncherry\ncherry" | uniq -D

# Output:

- apple
- apple
- cherry
- cherry

10. Combine sort and uniq to Process Unsorted Data
    echo -e "banana\napple\nbanana\ncherry\napple" | sort | uniq

# Output:

- apple
- banana
- cherry
