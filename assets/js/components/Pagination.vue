<template>
  <div>
    <ul>
      <li v-if="parseInt(page) > 1">
        <a :href="baseUrl + '&page=' + prev">
          <span class="selected">&#60;</span>
        </a>
      </li>
      <li v-for="index in parseInt(totalPages)">
        <a :href="baseUrl + '&page=' + index">
          <span v-if="index == page" class="selected">{{ index }}</span>
          <span v-else>{{index}}</span>
        </a>
      </li>
      <li v-if="parseInt(page) < parseInt(totalPages)">
        <a :href="baseUrl + '&page=' + next">
          <span class="selected">&#62;</span>
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
    computed: {
      prev() {
        return parseInt(this.page) - 1;
      },
      next() {
        return parseInt(this.page) + 1;
      }
    },
  }
</script>

<style scoped>
  li {
    display: inline-block;
    padding: 2px;
  }
  .selected {
    color:deepskyblue;
  }
  a {
    color: #000000;
  }
  ul {
    text-align: center;
  }
</style>