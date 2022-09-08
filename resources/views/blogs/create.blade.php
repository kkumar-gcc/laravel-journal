<x-base-layout>
    <?php
    function nice_number($n)
    {
        $n = 0 + str_replace(',', '', $n);
        if (!is_numeric($n)) {
            return false;
        }
        if ($n > 1000000000000) {
            return round($n / 1000000000000, 1) . 't ';
        } elseif ($n > 1000000000) {
            return round($n / 1000000000, 1) . 'b ';
        } elseif ($n > 1000000) {
            return round($n / 1000000, 1) . 'm ';
        } elseif ($n > 1000) {
            return round($n / 1000, 1) . 'k ';
        }
        return number_format($n);
    }
    ?>
    <div class="container-fluid blog-section">
        <div class="e-card">
            <div class="card-body profile-body">
                <h1 class="title mb-4">Create Post</h1>
                <form method="POST" action="{{ Route('blog.create') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="blog_id" name="blog_id" value="{{ old('blog_id', $draft->id ?? '') }} " />

                    <div class="form-group mb-4">
                        <label class="form-label" for="blog_image">Add a cover image</label>

                        <div class="drop-zone" id="blog_image">
                            <p class="drop-zone__prompt">Drop file here or click to upload</p>
                            <input type="file" name="image" id="blog_image" class="form-control drop-zone__input">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label " for="blog_title">Title</label>

                        <input type="text" id="blog_title" class="form-control" name="title"
                            value="{{ old('title', $draft->title ?? '') }}" />
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" for="myeditorinstance">Description</label>

                        <textarea id="myeditorinstance" name="description"> {{ old('description', $draft->description ?? '') }} </textarea>
                    </div>

                    <input type="hidden" name="tags" id="tag-input" value="{{ old('tags', $tagTitles ?? '') }}">
                    <div class="form-group mb-4 ">
                        <label class="form-label" for="js-typeahead-tags">Add Tags</label>
                        <div class="typeahead__container">
                            <div class="typeahead__field">
                                <div class="typeahead__query">
                                    <input class="js-typeahead-tags form-control" name="tag[query]" placeholder="Search"
                                        autocomplete="off" id="js-typeahead-tags">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="float-end" id="autoSave">

                        </div>
                    </div>
                    <button type="submit" class="mt-2 e-btn e-btn-success"> Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-base-layout>
{{-- @push('scripts')
    @include('ajax')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            typeof $.typeahead === 'function' && $.typeahead({
                input: '.js-typeahead-tags',
                minLength: 1,
                maxItem: 8,
                maxItemPerGroup: 6,
                order: "asc",
                hint: true,
                blurOnTab: true,
                correlativeTemplate: ["title"],
                matcher: function(item, displayKey) {
                    if (item.id === "BOS") {
                        item.disabled = true;
                    }
                    return true;
                },
                multiselect: {
                    limit: 5,
                    limitTemplate: 'You can\'t select more than 5 tags',
                    matchOn: ["title"],
                    cancelOnBackspace: true,
                    data: function() {
                        var deferred = $.Deferred();
                        var isDraftNull = "{{ $isDraftNull }}";
                        if (isDraftNull == 1) {
                            var tags = @json($draft->tags ?? '');
                            $.each(tags, function() {
                                Object.assign(this, {
                                    matchedKey: "title",
                                    group: "tag",
                                });
                            })
                            deferred.resolve(tags);
                        }
                        return deferred;
                    },
                    callback: {
                        onClick: function(node, item, event) {
                            console.log(item.title);
                        },
                        onCancel: function(node, item, event) {
                            var tags = [];
                            var temp = [];
                            if ($("#tag-input").val() != '') {
                                temp = tags.concat(tags, JSON.parse($("#tag-input").val()));
                            }
                            if (temp.includes(item.title)) {
                                const index = temp.indexOf(item.title);
                                console.log(index);
                                if (index > -1) {
                                    temp.splice(index, 1);
                                }
                            }
                            $("#tag-input").val(JSON.stringify(temp));
                        }
                    }
                },
                dynamic: true,
                hint: true,
                template: function(query, item) {

                    return ` <div class="e-card  shadow-1  ">
                        <div class="e-card-body">
                            <a href="/blogs/tagged/` + item.title + `" class="tag-popover"
                                id="tag-` + item.id + `"><span class="modern-badge  modern-badge-` + item.color +
                        `">` + item.title + `</span>
                            </a>
                            <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the bulk of
                                the card's content.Some quick example text to build on the card title and make up the bulk of
                                the card's content.Some quick example text to build on the card title and make up the bulk of
                                the card's content.Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <span class="text-muted">` + item.blogs_count + `blogs</span>
                        </div>
                    </div>`
                },
                templateValue: name,
                display: ["title", "color", "description"],
                emptyTemplate: function(query) {
                    return `no result for "` + query + `"`;
                },
                source: {
                    tag: {
                        ajax: function(query) {
                            return {
                                url: "/tags/search",
                                type: 'GET',
                                data: {
                                    query: query
                                },
                                dataType: 'json',
                                callback: {
                                    done: function(data) {

                                        return data.tags;
                                    }
                                }
                            }
                        },

                    }
                },
                callback: {
                    onClickAfter: function(node, a, item, event) {
                        var tags = [];
                        var temp = [];
                        if ($("#tag-input").val() != '') {
                            temp = tags.concat(tags, JSON.parse($("#tag-input").val()));
                        }
                        if (!temp.includes(item.title)) {
                            temp.push(item.title);
                        }
                        $("#tag-input").val(JSON.stringify(temp));
                    }
                },
            });

            function autoSave() {
                var blog_title = $("#blog_title").val();
                var blog_description = tinyMCE.activeEditor.getContent();
                var blog_id = $("#blog_id").val();
                var tag_input = $("#tag-input").val();
                if (blog_title != '' && blog_description != '') {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('blog.draft') }}",
                        data: {
                            blogTitle: blog_title,
                            blogDescription: blog_description,
                            blogId: blog_id,
                            tags: tag_input,

                        },
                        beforeSend: function() {
                            $("#autoSave").html(
                                " <span class='text-center modern-badge  modern-badge-danger' > <div class='spinner-border spinner-border-sm' role='status' > <span class='visually-hidden'>Loading...</span> </div> Saving...</span>"
                            );
                        },
                        complete: function() {
                            $("#autoSave").html(
                                "<span class='text-right modern-badge  modern-badge-success'>Saved</span>"
                            );
                        },
                        success: function(data) {

                            if (data.blogId != '') {
                                $("#blog_id").val(data.blogId);
                            }
                        }

                    });
                }
            }
            setInterval(function() {

                autoSave();
            }, 10000);

        });
    </script>
@endpush --}}
