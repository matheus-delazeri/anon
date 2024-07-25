@props(['disabled' => false, 'maxLength' => 255])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700
dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
dark:focus:ring-indigo-600 rounded-md shadow-sm overflow-y-hidden', 'maxlength' => $maxLength, 'rows' => 1,
'oninput' => 'this.style.height = "";this.style.height = this.scrollHeight + "px"' ]) !!} style="resize: none"></textarea>
