<template>
  <DefaultField
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    :full-width-content="fullWidthContent"
  >
    <template #field>
      <div class="relative">
        <!-- Simbolo della valuta preso dal meta del field -->
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none ">
          <span class="text-gray-500 text-lg">{{ field.currency }}</span>
        </div>
        <input
          :id="field.attribute"
          type="number"
          step="0.01"
          class="w-full form-control form-input form-control-bordered pl-10 pr-10"
          :class="errorClasses"
          :placeholder="field.name"
          v-model="value"
          :disabled="isLocked"
        />
        <!-- Icona del lucchetto in SVG a destra -->
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
          <button type="button" @click="toggleLock" class="focus:outline-none">
            <span v-if="isLocked">
              <!-- SVG per lock closed -->
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
              </svg>
            </span>
            <span v-else>
              <!-- SVG per lock open -->
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                <path d="M18 1.5c2.9 0 5.25 2.35 5.25 5.25v3.75a.75.75 0 0 1-1.5 0V6.75a3.75 3.75 0 1 0-7.5 0v3a3 3 0 0 1 3 3v6.75a3 3 0 0 1-3 3H3.75a3 3 0 0 1-3-3v-6.75a3 3 0 0 1 3-3h9v-3c0-2.9 2.35-5.25 5.25-5.25Z" />
              </svg>
            </span>
          </button>
        </div>
      </div>
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  data() {
    return {
      isLocked: true // campo inizialmente bloccato
    }
  },

  methods: {
    // Imposta il valore iniziale del campo
    setInitialValue() {
      this.value = this.field.value || ''
    },

    // Riempi il FormData con il valore del campo
    fill(formData) {
      formData.append(this.fieldAttribute, this.value || '')
    },

    // Alterna lo stato di lock/unlock
    toggleLock() {
      this.isLocked = !this.isLocked
    },
  },
}
</script>
