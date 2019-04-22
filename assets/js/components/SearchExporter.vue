<template>
  <div>
    <button
      v-if="!started"
      @click="startExport">
      Export to xls
    </button>
    <button v-else-if="!finished" disabled>
      Loading...
    </button>
    <a v-else="" :href="downloadUrl">
      <button >
        Download
      </button>
    </a>
  </div>
</template>

<script>
  export default {
    name: "SearchExporter",
    props: {
      value: {
        required: false
      },
      field: {
        required: false
      },
    },
    data: function () {
      return {
        taskId: null,
        started: false,
        finished: false
      }
    },
    methods: {
      startExport() {
        this.started = true;
        this.$http.get('/export?searchField=' + this.field + '&searchValue=' + this.value).then(
          this.handleStartResponse
        );
      },
      handleStartResponse(response) {
        this.taskId = response.data.taskId;
        setTimeout(this.pollStatus, 1000);
      },
      pollStatus() {
        this.$http.get('/export/status/' + this.taskId).then(
          this.handleStatusResponse
        );
      },
      handleStatusResponse(response) {
        console.log(response.data);
        if (response.data.status == 'complete') {
          this.finished = true;
        } else {
          setTimeout(this.pollStatus, 1000);
        }
      },
    },
    computed: {
      downloadUrl() {
        return '/export/download/' + this.taskId;
      }
    }
  }
</script>

<style scoped>

</style>