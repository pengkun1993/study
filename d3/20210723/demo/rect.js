const svgW = 600;
const svgH = 600;

const svg = d3.select('body')
              .append('svg')
              .attr('width', svgW)
              .attr('height', svgH);


const margin = { top: 60, bottom: 60, left: 60, right: 60 } // 设置边距
const dataset = [ 250 , 210 , 170 , 130 , 90 ];  // 数据（表示矩形的宽度）

const g = svg.append('g')
              .attr('transform', `translate(${margin.top}, ${margin.left})`);

const rectHeight = 30; // 矩形的高度

g.selectAll('rect')
  .data(dataset)
  .enter()
  .append('rect')
  .attr('x', 20)
  .attr('y', (d, i) => {
    return i * rectHeight;
  })
  .attr('width', d => d)
  .attr('height', rectHeight - 5)
  .attr('fill', 'blue');

  // 坐标轴
  //为坐标轴定义一个线性比例尺
  const xScale = d3.scaleLinear()
                 .domain([0,d3.max(dataset)])
                 .range([0,250]);
  //定义一个坐标轴
  const xAxis = d3.axisBottom(xScale) // 定义一个axis，由bottom可知，是朝下的
                .ticks(5);//设置刻度数目

  const temp = g.append('g')
   .attr('transform', `translate(20, ${dataset.length * rectHeight})`)
   .call(xAxis);

   // xAxis(temp);