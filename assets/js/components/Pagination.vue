<template>
  <div>
    <ul>
      <li v-for="index in parseInt(totalPages)">
        <a :href="baseUrl + '&page=' + index">
          <span v-if="index == page" class="selected">{{ index }}</span>
          <span v-else>{{index}}</span>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>

  export default {
    name: "Pagination",
    props: {
      baseUrl: {
        required: true
      },
      page: {
        required: true
      },
      totalPages: {
        required: true
      },
    },
    methods: {
    },
  }
</script>

<style scoped>
  li {
    display: inline-block;
    padding: 2px;
  }
  .selected {
    color:green;
  }
  a {
    color: #000000;
  }
</style>