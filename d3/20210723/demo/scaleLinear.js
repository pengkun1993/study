const dataset = [1.2, 2.3, 0.9, 1.5, 3.3];
const min = d3.min(dataset);//得到最小值
const max = d3.max(dataset);//得到最大值

const scaleLinear = d3.scaleLinear()
  .domain([min,max])
  .range([0,300]);

console.log('scaleLinear(1)输出：'+scaleLinear(1));

console.log('scaleLinear(2)输出：'+scaleLinear(2));

console.log('scaleLinear(3.2)输出：'+scaleLinear(3.2));

console.log('scaleLinear(3.3)输出：'+scaleLinear(3.3));

console.log('scaleLinear(3.4)输出：'+scaleLinear(3.4));