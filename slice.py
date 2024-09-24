from array import *
a=array('i',[1,2,3,4,5,6])
print("length is :",len(a))
print("array is")
for i in range(len(a)):
 print(a[i])
a.append(7)
print("after append")
for i in range(len(a)):
 print(a[i])
a.extend([8,9,4])
print("after extend")
for i in range(len(a)):
 print(a[i])
print("slicing is ",a[1:5])
print("index is",a.index(5))
a.remove(4)
print("after removing")
for i in  range(len(a)):
 print(a[i])
