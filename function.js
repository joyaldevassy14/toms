
   
  
console.log("hello")
let greeet=(n=7)=>{
    var str="hello  world"
    console.log('hello',n)
    return str
}
var str2=greeet()
console.log(str2)

let add=function(num1,num2){
    return num1+num2}

var n=add(3,4)
console.log(n)

let sum=(num1)=>console.log(num1)

sum(5)

let laptop={
    cpu:'i9',
    ram:16,
    brand:'hp',

    greet:function(){
        console.log("hello")
    }
}
laptop.greet();

let computer={
    type1:'laptop',
    type2:'desktop',
    type3:'mac',

    greet:function(){
        var w=100
        console.log(w)
        console.log(this.type1)
    }
}
computer.greet();
console.log(computer.type1)
console.log(computer)


let a=[4,"6",8.7,function(){
    console.log("hello");
},{tech:35}]
a.push(9)
a[3]="2000"
console.log(a);
console.log(a.length)
console.log(a[2])
console.log(a[4])
a.pop()
console.log(a.pop(4))
console.log(a)
console.log(a.shift())
console.log(a)
console.log(a.unshift(2))
console.log(a)
console.log(a.splice(3))
console.log(a)

let b=[];
for(var i=0;i<10;i++){
    b.push(i)
}
for(i=0;i<10;i++){
    console.log(b[i])
}
let ab=5;
let cd=6;
[ab,cd]=[cd,ab]
console.log(ab,cd)
let words="naveen ,red,dy ,joyal";
console.log(words.split(','));
console.log(document);
