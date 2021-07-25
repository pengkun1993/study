const svgH = 600;
const svgW = 600;
const margin = 60;

const svg = d3.select('body')
              .append('svg')
              .attr('width', svgW)
              .attr('height', svgH);

const g = svg.append('g')
              .attr('transform', `translate(${svgW/2}, ${svgH/2})`);

const dataset = [ 30 , 10 , 43 , 55 , 13 ]; // 需要将这些数据变成饼状图的数据

// 颜色比例尺
const colorScale = d3.scaleOrdinal()
                      .domain(d3.range(dataset.length))
                      .range(d3.schemeCategory10);

const pie = d3.pie();

const innerRadius = 0; // 内半径
const outerRadius = 100; // 外半径
const arc_generator = d3.arc().innerRadius(innerRadius).outerRadius(outerRadius);

const pieData = pie(dataset);
console.log(pieData);

const pgs = g.selectAll('g')
              .data(pieData)
              .enter()
              .append('g');
pgs.append('path')
    .attr('d', d => arc_generator(d))
    .attr('fill', (d, i) => colorScale(i));
pgs.append('text')
    .attr('transform',function(d){//位置设在中心处
      return `translate(${arc_generator.centroid(d)})`;
    })
    .attr('text-anchor', 'middle')
    .text(d => d.data);