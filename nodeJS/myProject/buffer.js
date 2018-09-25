const buf = Buffer.from('runoob');
console.log(buf);
console.log(buf.toString('hex'));
console.log(buf.toString('base64'));

console.log('---------------')
// 创建一个长度为10，且用0填充的Buffer
const buf1=Buffer.alloc(10);
console.log('buf1',buf1);
//创建一个长度为10、其用0x1填充的Buffer
const buf2=Buffer.alloc(10,1);
console.log('buf2',buf2);
//创建一个长度为10、且未被初始化的Buffer，
//这个方法比调用Buffer.alloc()更快，
//但返回的Buffer实例可能包含旧数据，
//因此需要使用fill()或write()重写。
const buf3 = Buffer.allocUnsafe(10);
console.log('buf3',buf3);
// 创建一个包含[0x1,0x3,0x3]的Buffer
const buf4 = Buffer.from([1,2,3]);
console.log('buf4',buf4);
// 创建一个包含utf-8字节[0x74,0xc3,0xa9,0x73,0x74]的Buffer
const buf5 = Buffer.from('tést');
console.log('buf5',buf5);
// 创建一个包含Latin-1字节[0x74,0xe9,0x73,0x74]的Buffer
const buf6 = Buffer.from('tést','latin1');
console.log('buf6',buf6);