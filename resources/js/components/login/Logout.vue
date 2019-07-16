<template>
</template>

<script type="text/javascript">
  export default {
    created() {
      EventBus.$emit('logout')
    }
  }
</script>
