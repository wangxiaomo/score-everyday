<style>
#calendar-chart { margin-top: 20px; }
</style>

<template>
  <div>
    <div id="calendar-chart"></div>
    <score-button-group @sync='loadUserData'></score-button-group>
  </div>
</template>

<script>
  function initScoreCalendar() {
    var today = new Date(),
        year = today.getFullYear(),
        month = today.getMonth() + 1;

    var screenWidth = $("#calendar-chart").width(),
        width = screenWidth - 20,
        cellSize = Math.floor(width / 30),
        height = cellSize * 7,
        axisHeight = 30;

    var svg = d3.select("#calendar-chart")
      .selectAll("svg")
      .data([year])
      .enter().append("svg")
        .attr("width", width)
        .attr("height", height + axisHeight)
      .append("g")
        .attr("transform", "translate(" + ((width - cellSize * 30) / 2) + ", 0)");

    svg.append("text")
        .attr("transform", "translate(10," + cellSize * 3.5 + ")rotate(-90)")
        .attr("font-family", "sans-serif")
        .attr("font-size", 15)
        .attr("text-anchor", "middle")
        .text(function(d) { return d; });

    var rect = svg.append("g")
        .attr("class", "rect-target")
        .attr("fill", "none")
        .attr("stroke", "#ccc")
        .attr("transform", "translate(-" + cellSize * 11 + ", 0)")
      .selectAll("rect")
      .data(function(d) { return d3.timeDays(new Date(d, month-6, 1), new Date(d, month, 1)); })
      .enter().append("rect")
        .attr("width", cellSize)
        .attr("height", cellSize)
        .attr("x", function(d) { return d3.timeWeek.count(d3.timeYear(d), d) * cellSize; })
        .attr("y", function(d) { return d.getDay() * cellSize; })
        .datum(d3.timeFormat("%Y/%m/%d"));

    var text = svg.append("g")
        .attr("class", "text-target")
        .attr("fill", "none")
        .attr("stroke", "#000")
        .attr("transform", "translate(-" + cellSize * 11 + ", 0)")
      .selectAll("text")
      .data(function(d) { return d3.timeDays(new Date(d, month-6, 1), new Date(d, month, 1)); })
      .enter().append("text")
        .attr("x", function(d) { return d3.timeWeek.count(d3.timeYear(d), d) * cellSize + cellSize/3; })
        .attr("y", function(d) { return d.getDay() * cellSize + cellSize/1.5; })
        .attr("font-size", "1rem")
        .datum(d3.timeFormat("%Y/%m/%d"));

    svg.append("g")
        .attr("fill", "none")
        .attr("stroke", "#000")
        .attr("transform", "translate(-" + cellSize * 11 + ", 0)")
      .selectAll("path")
      .data(function(d) { return d3.timeMonths(new Date(d, month-6, 1), new Date(d, month, 1)); })
      .enter().append("path")
        .attr("d", pathMonth);

    var cnMonths = ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"];
    svg.append("g")
        .attr("transform", "translate(" + cellSize*3 + ", " + (height+axisHeight-10) + ")")
      .selectAll("text")
      .data(cnMonths.slice(month-6,month))
      .enter().append("text")
        .attr("x", function(d, i) { return cellSize*27/6*i; })
        .attr("font-size", 12)
        .attr("text-anchor", "middle")
        .text(function(d) { return d; });

    function pathMonth(t0) {
      var t1 = new Date(t0.getFullYear(), t0.getMonth() + 1, 0),
          d0 = t0.getDay(), w0 = d3.timeWeek.count(d3.timeYear(t0), t0),
          d1 = t1.getDay(), w1 = d3.timeWeek.count(d3.timeYear(t1), t1);
      return "M" + (w0 + 1) * cellSize + "," + d0 * cellSize
          + "H" + w0 * cellSize + "V" + 7 * cellSize
          + "H" + w1 * cellSize + "V" + (d1 + 1) * cellSize
          + "H" + (w1 + 1) * cellSize + "V" + 0
          + "H" + (w0 + 1) * cellSize + "Z";
    }

  }

  function loadUserData() {
    var color = d3.scaleQuantize()
        .domain([-10, 10])
        .range([
          '#FF0000', '#FF4500', '#FF7F24', '#FFA500', '#FFC125', '#FFEC8B', '#FFFFE0',
          '#C1FFC1', '#54FF9F', '#00EE00', '#00CD00', '#008B45', '#006400',
        ]);

    var rect = d3.selectAll('.rect-target rect'),
        text = d3.selectAll('.text-target text');
    d3.json("/user_data", function(error, data) {
      if (error) throw error;

      rect.filter(function(d) { return d in data; })
          .attr("fill", function(d) { return color(data[d]); })
        .append("title")
          .text(function(d) { return d + " score: " + data[d]; });
      text.filter(function(d) { return d in data; })
          .text(function(d) { return data[d]; });
    });
  }

  import ScoreButtonGroup from './ScoreButtonGroup.vue'

  export default {
    data () {
      return {}
    },
    mounted () {
      initScoreCalendar();
      loadUserData();
    },
    methods: {
      loadUserData
    },
    components: {
      ScoreButtonGroup
    }
  }
</script>
