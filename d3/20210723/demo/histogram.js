const svgH = 600;
const svgW = 600;
const margin = 60;
const padding = 20;

const svg = d3.select('body')
              .append('svg')
              .attr('width', svgW)
              .attr('height', svgH);

const g = svg.append('g')
              .attr('transform', `translate(${margin}, ${margin})`);
// 数据
const dataset = [10, 20, 30, 23, 13, 40, 27, 35, 20];
// x坐标轴
const xScale = d3.scaleBand()
                  .domain(d3.range(dataset.length))
                  .rangeRound([0, svgW - (margin * 2)]);
const xAxis = d3.axisBottom(xScale);
g.append('g')
  .attr('transform', `translate(0, ${svgH - (margin * 2) })`)
  .call(xAxis);
// y坐标轴
const yScale = d3.scaleLinear()
                  .domain([0, d3.max(dataset)])
                  .range([svgH - (margin * 2), 0]);
const yAxis = d3.axisLeft(yScale);
g.append('g').call(yAxis);
// 数据分组
const dgs = g.selectAll('.rect')
              .data(dataset)
              .enter()
              .append('g')
              .attr('class', 'rect');

const rectPadding = 20; // 矩形之间的间隔

// 画柱子
dgs.append('rect')
    .attr('x', function(d, i) {
      return xScale(i) + rectPadding/2;
    })
    .attr('y', function(d, i){
      const min = yScale.domain()[0];
      return yScale(min);
    })
    .attr('width', function() {
      return xScale.step() - rectPadding;
    })
    .attr('height', 0)
    .on('mouseover', function() {
    d3.select(this)
      // .transition()
      // .duration(1500)
      .attr('fill', 'yellow');
    })
    .on('mouseout', function() {
    d3.select(this)
      // .transition()
      // .duration(1500)
      .attr('fill', 'blue');
    })
    .transition()
    .duration(2000)
    .delay((d, i) => i*200)
    .attr('y', function(d, i){
      return yScale(d);
    })
    .attr('height', function(d) {
      return svgH - (margin * 2) - yScale(d)
    })
    .attr('fill', 'blue');
  //  https://www.coder.work/article/1191655
// 绘制文字
dgs.append('text')
    .attr('x', (d, i) => {
      return xScale(i) + rectPadding/2;
    })
    .attr('y', function(d, i){
      const min = yScale.domain()[0];
      return yScale(min);
    })
    .attr('dx', 0)
    .attr('dy', -5)
    .text(d => d)
    .transition()
    .duration(2000)
    .delay((d, i) => i*200)
    .attr('y', d => yScale(d));