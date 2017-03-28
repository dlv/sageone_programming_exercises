# SageOne Brasil Local Programming Exercise.

This exercise is intended to be applied in a face-to-face interview. You should answer these questions without using a computer or internet. Use only a pencil, a paper and your expertise. :smirk:

### General Rules:
- You can write the answer using any programming language. The goal here is not to evaluate your Ruby experience. Do not care about the perfect syntax. The goal is to see your familiarity with algorithms and logic skills.
- You **CAN'T** use modern languages helpers functions. You can't use Ruby's `.to_s` or `.to_i`, for instance. You can code **only** basic structures and data types.


### Exercices:

1. Write an algorithm that sum all the elements present in an `Array`. It takes an `Array` as input and should return the sum of all elements inside:

  ```ruby
  array_sum([14,52,67,44])
  # should return 177
  ```
  ---

2. Write an algorithm that revert a given string. It should invert every string character:

  ```ruby
  revert_string('Marco')
  # should return 'ocraM'
  ```

  > TIP: It is okay to assume that a string is an Array of characters.

  ---

3. Write a function that convert an `Integer` to a `String`. **Remember:** you **can't** use existing helper functions like `1234.to_s` :cry:

  ```ruby
  integer_to_string(1234)
  # should return '1234'
  ```
  ---

4. Now the opposite, write a function that convert a `String` to an `Integer`. Again, you **can't** use existing helper functions like `"7485".to_i`.

  ```ruby
  string_to_integer("7485")
  # should return 7485
  ```
  ---

5. Write the function fizzbuzz. If a number is divisible by 3, return "Fizz". If a number is divisible by 5, return "Buzz". If a number is divisible by 3 and 5, return "FizzBuzz"

 ```ruby
  fizzbuzz(3)
  # should return "Fizz"
  fizzbuzz(5)
  # should return "Buzz"
  fizzbuzz(5175)
  # should return "FizzBuzz"
  
  ```
  ---
6. What will this line of Ruby code return and why?

  ```ruby
  true and 0 && !nil and 3 > 2
  ```
  ---
