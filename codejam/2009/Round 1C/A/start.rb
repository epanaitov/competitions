input = File.new("/home/eugene/www/codejam/2009/Round 1C/A/input", "r")
output = File.new("/home/eugene/www/codejam/2009/Round 1C/A/output", "w")

N = input.gets.to_i

for x in 1..N
  
  symbols = input.gets.strip!
  
  digits = {}
  
  first = symbols[0, 1]
  
  digits[first] = 1;
  
  number = [1]
  
  for i in 1..symbols.length
    sym = symbols[i, 1]
    
    if sym == first
      number[i] = 1
    else
      digits[sym] = 0
      number[i] = 0
      break
    end
  end
  
  if number.length < symbols.length
    last = 1
    for j in i+1..symbols.
  end
  
end



number = [1,0,2,3,4,0,5,6,7,8,4,1,9,3,10,11,12]
base = 13

result = 0

for i in 0..number.length-1
	result = result + number.fetch(i) * (base**(number.length-i-1))
end

puts result

input.close
output.close