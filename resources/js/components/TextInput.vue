
<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: [String, Number],
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="border-gray-300 hover:border-gray-400 focus:border-sky-500 focus:ring-sky-500 rounded-lg shadow-sm"
        v-model="model"
        ref="input"
    />
</template>
