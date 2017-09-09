<style>
span.glyphicon { font-size:15px; }
</style>

<template>
  <div class="button-groups text-center">
    <button type="button" class="btn btn-success col-xs-4 col-xs-offset-1" @click="incr(1)">+1</button>
    <button type="button" class="btn btn-danger col-xs-4 col-xs-offset-2" @click="incr(-1)">-1</button>
  </div>
</template>

<script>
export default {
  data () {
    return {}
  },
  methods: {
    incr: function(step) {
      var vueElement = this;
      axios.post('/incr/' + step)
        .then(function(res){
          var notifyType,msg;
          if(step > 0){
            notifyType = 'success';
            msg = '坚持不易，继续努力';
          }else{
            notifyType = 'danger';
            msg = '坚持不易，下不为例';
          }
          $.notify({message:msg},{type:notifyType, delay:2000});
          vueElement.$emit('sync');
        });
    }
  }
}
</script>
