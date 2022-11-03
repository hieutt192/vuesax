<script>
export default {
  props: {
    maxVisibleButtons: {
      type: Number,
      required: false,
      default: 3
    },
    totalPages: {
      type: Number,
      required: true
    },
    total: {
      type: Number,
      required: true
    },
    currentPage: {
      type: Number,
      required: true
    }
  }
};
</script>
<template>
  <ul>
    <li>
      <button type="button">
        First
      </button>
    </li>
    <li>
      <button type="button">
        Previous
      </button>
    </li>
    <!-- Range of pages -->
    <li>
      <button type="button">
        Next
      </button>
    </li>
    <li>
      <button type="button">
        Last
      </button>
    </li>
  </ul>
</template>
