<div x-data="{ open: false }">
    {{-- <button @click="expanded = ! expanded">Toggle Content</button>

    <div x-show="expanded" x-collapse>
      <p>Content Here</p>

      <div x-data="{ expanded: false }">
        <button @click="expanded = ! expanded">Toggle Content</button>

          <p x-show="expanded" x-collapse>nested content here</p>
      </div>
    </div> --}}
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open" x-collapse x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" class=" z-50 mt-2" style="display: none;">
        {{ $content }}
    </div>
</div>
