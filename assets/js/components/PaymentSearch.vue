<template>
  <div class="flex">
    <div class="flex flex_1-1">
      <div class="flex_1-10 label">
        Field:
      </div>
      <div class="flex_9-10 flex">
        <select v-model="searchField" @change="fieldChange" name="searchField" class="flex_1-1">
          <slot name="searchFields">
          </slot>
        </select>
      </div>
    </div>
    <div class="flex flex_1-1">
      <div class="flex_1-10 label">
        Value:
      </div>
      <div class="flex_9-10">
        <div class="flex">
          <input type="text"
                 placeholder="Query"
                 autocomplete="off"
                 v-model="query"
                 @keydown.down="down"
                 @keydown.up="up"
                 @keydown.enter="hit"
                 @keydown.esc="reset"
                 @blur=""
                 @input="update"
                 class="flex_1-1"
          />
          <ul v-show="hasItems" class="flex_1-1">
            <li v-for="(item, $item) in items" :class="activeClass($item)" @mousedown="hit" @mousemove="setActive($item)">
              <span v-text="item.name"></span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="flex_1-1">
      <div><button @click="search">Search</button></div>
    </div>
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
      onHit (item) {
        window.location.href = "/?searchField=" + this.searchField + "&searchValue=" + item.name;
      },
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
  .label {
    size: 24px;
  }
  input {
    width: 100%;
  }
  li {
    border-bottom: 1px solid lightgrey;
    padding-bottom: 2px;
  }
</style>