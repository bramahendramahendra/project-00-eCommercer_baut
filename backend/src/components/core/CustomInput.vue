<template>
    <div>
        <label class="sr-only">{{ label }}</label>
        <div class="mt-1 flex rounded-md shadow-sm">
            <span v-if="prepend"
                class="inline-flex items-center px-3 rounded-l-md border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">{{
                    prepend }}</span>

            <template v-if="type === 'combobox'">
                <div class="relative w-full">
                    <!-- <Combobox as="div" v-model="innerValue" @update:model-value="emit('update:modelValue', $event)"> -->
                    <Combobox as="div" v-model="innerValue" >
                        <ComboboxInput
                            :placeholder="placeholder"
                            class="w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            @input="updateFilter" :display-value="(option) => option?.[optionText]"
                        />
                        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                        </ComboboxButton>

                        <ComboboxOptions v-if="filteredOptions.length > 0" class="absolute z-30 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ComboboxOption
                                v-for="option in filteredOptions"
                                :key="option[optionValue]"
                                :value="option"
                                v-slot="{ active, selected }"
                                >
                                <li :class="getOptionClass(active, selected)">
                                    <span :class="['block truncate', selected && 'font-semibold']">
                                    {{ option[optionText] }}
                                    </span>
                                     <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                        <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                    </span>
                                </li>
                               
                            </ComboboxOption>
                        </ComboboxOptions>
                    </Combobox>
                </div>
            </template>


            <template v-else-if="type === 'textarea'">
                <textarea :name="name" :required="required" :value="props.modelValue"
                    @input="emit('update:modelValue', $event.target.value)" :class="inputClasses"
                    :placeholder="label"></textarea>
            </template>
            <template v-else-if="type === 'file'">
                <input :type="type" :name="name" :required="required" @input="emit('change', $event.target.files[0])"
                    :class="inputClasses" :placeholder="label" />
            </template>
            <template v-else>
                <input :type="type" :name="name" :required="required" :value="props.modelValue"
                    @input="emit('update:modelValue', $event.target.value)" :class="inputClasses" :placeholder="label" :autocomplete="autocomplete"
                    step="0.01" />
            </template>
            <span v-if="append"
                class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                {{ append }}
            </span>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, computed } from 'vue';
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxOptions,
    ComboboxOption,
} from '@headlessui/vue';
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
    modelValue: [String, Number, File, Object],
    label: String,
    type: {
        type: String,
        default: 'text'
    },
    name: String,
    required: Boolean,
    prepend: {
        type: String,
        default: ''
    },
    append: {
        type: String,
        default: ''
    },
    options: Array,
    optionValue: String,
    optionText: String,
    placeholder: String,
    autocomplete: {
        type: String,
        default: ''
    }
})

const inputClasses = computed(() => {
    const cls = [
        'block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-30 sm:text-sm',
    ];

    if (props.append && !props.prepend) {
        cls.push('rounded-l-md')
    } else if (props.prepend && !props.append) {
        cls.push('rounded-r-md')
    } else if (!props.prepend && !props.append) {
        cls.push('rounded-md')
    }

    return cls.join(' ')
})

const emit = defineEmits(['update:modelValue', 'change'])
const innerValue = ref(props.modelValue);

watch(innerValue, (newVal) => {
    emit('update:modelValue', newVal);
});

const filteredOptions = ref(props.options || []);
watch(() => props.options, (newOptions) => {
    filteredOptions.value = newOptions;
}, { immediate: true });

const updateFilter = (event) => {
    const query = event.target.value;
    filteredOptions.value = props.options.filter((option) =>
        option[props.optionText].toString().toLowerCase().includes(query.toLowerCase())
    );
};

const getOptionClass = (active, selected) => {
    return [
        'relative cursor-default select-none py-2 pl-3 pr-9',
        active ? 'bg-indigo-600 text-white' : 'text-gray-900',
        // selected ? 'font-semibold' : ''
    ].join(' ');
};

</script>

<style scoped></style>