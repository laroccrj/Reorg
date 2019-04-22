<template>
  <div>
    <div>
      <select v-model="searchField" @change="fieldChange" name="searchField">
        <slot name="searchFields">
        </slot>
      </select>
    </div>

    <div>
    <input type="text"
           placeholder="Query"
           autocomplete="off"
           v-model="query"
           @keydown.down="down"
           @keydown.up="up"
           @keydown.enter="hit"
           @keydown.esc="reset"
           @blur=""
           @input="update"/>
    </div>

    <div>
      <ul v-show="hasItems">
        <li v-for="(item, $item) in items" :class="activeClass($item)" @mousedown="hit" @mousemove="setActive($item)">
          <span class='typeaheadItem' v-text="item.name"></span>
        </li>
      </ul>
    </div>
    <div><button @click="search">Search</button></div>
  </div>
</template>

<script>
  import VueTypeahead from 'vue-typeahead'

  export default {
    extends: VueTypeahead,
    name: "PaymentSearch",
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
        searchField: this.field,
        src: '/typeahead?searchField=' + this.field + '&searchValue=',
        data: {},
        limit: 5,
        minChars: 2,
        selectFirst: false,
        queryParamName: '',
        searchValue: this.value
      }
    },
    methods: {
      search() {
        window.location.href = "/?searchField=" + this.searchField + "&searchValue=" + this.query;
      },
      // The callback function which is triggered when the user hits on an item
      // (required)
      onHit (item) {
        window.location.href = "/?searchField=" + this.searchField + "&searchValue=" + item.name;
      },

      // The callback function which is triggered when the response data are received
      // (optional)
      prepareResponseData (data) {
        let items = [];

        for(let i = 0; i < data.results.length; i++) {
          items.push({name : data.results[i]});
        }

        return items;
      },

      fieldChange () {
        this.src = '/typeahead?searchField=' + this.searchField + '&searchValue=';
      }
    },
    mounted : function(){
      this.query = this.searchValue;
    }
  }
</script>

<style scoped>

</style>