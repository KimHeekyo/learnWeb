// 'use strict';
// // var & let : Javascript에서 변수 선언시 사용하는 키워드
// // var : 유연성을 가진다. ===> 선언 전에도 사용 가능, 재선언이 가능
// var x, y, z;
// x = 5;
// y = 6;
// z = x + y;
// var x = 10;
// // let : 유연성이 없다. ==> 사용 전에 반드시 선언해야하고, 재선언 불가능

// {
//     var b = 10;     // not block scope
//     let a;
//     a = 5;          // block scope 취급
// console.log(a);
// }
// console.log(b);

// undefined
var x;
x = "1.0";
// 변수를 선언하고, 값을 초기화 하면
// 리터럴의 데이터 타입에 따라 변수의 타입이 결정된다.
console.log(typeof x);

var y;
console.log(typeof y);


// 숫자와 문자의 혼합 연산
var a = 5;
var b = 10;
var c = 'k';
console.log(a + b + c);

var a = 5;
var b = '10';
console.log(a + b);

var a = '5';
var b = '10';
var c = a + b;
console.log(c);


console.log( 5 == '5');
console.log( 5 === '5');

console.log('=======================')
let car;
car = undefined;
console.log(typeof car);