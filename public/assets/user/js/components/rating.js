window.jQuery && function (h) {
    if (!h.support.opacity && !h.support.style) try {
        document.execCommand("BackgroundImageCache", !1, !0)
    } catch (t) {
    }
    h.fn.rating = function (t) {
        if (0 === this.length) return this;
        if ("string" == typeof t) {
            if (1 < this.length) {
                var a = arguments;
                return this.each(function () {
                    h.fn.rating.apply(h(this), a)
                })
            }
            return h.fn.rating[t].apply(this, h.makeArray(arguments).slice(1) || []), this
        }
        var u = h.extend({}, h.fn.rating.options, t || {});
        return h.fn.rating.calls++, this.not(".star-rating-applied").addClass("star-rating-applied").each(function () {
            var t, a = h(this),
                i = (this.name || u.name || "unnamed-rating" + (u.stars ? "-" + h.fn.rating.calls : "")).replace(/\[|\]/g, "_").replace(/^\_+|\_+$/g, ""),
                r = h(this.form || document.body);
            if (!a.is("input")) {
                if (u.stars) return a.html(Array(u.stars + 1).join('<input type="radio" name="' + i + '"/>')), a.find("input").each(function (t) {
                    h(this).val(u.values ? u.values[t] : t + 1)
                }).rating(u);
                throw"Invalid star rating plugin call"
            }
            var n = r.data("rating");
            n && n.call == h.fn.rating.calls || (n = {count: 0, call: h.fn.rating.calls});
            var s = n[i] || r.data("rating" + i);
            s && (t = s.data("rating")), s && t ? t.count++ : ((t = h.extend({}, u || {}, (h.metadata ? a.metadata() : h.meta ? a.data() : null) || {}, {
                count: 0,
                stars: [],
                inputs: []
            })).serial = n.count++, s = h('<span class="star-rating-control" aria-hidden="true" />'), a.before(s), s.addClass("rating-to-be-drawn"), (a.attr("disabled") || a.hasClass("disabled")) && (t.readOnly = !0), a.hasClass("required") && (t.required = !0), s.append(t.cancel = h('<div class="rating-cancel rater-cancel-' + t.serial + '"><a title="' + t.cancel + '">' + t.cancelValue + "</a></div>").on("mouseover", function () {
                h(this).rating("drain"), h(this).addClass("star-rating-hover")
            }).on("mouseout", function () {
                h(this).rating("draw"), h(this).removeClass("star-rating-hover")
            }).on("click", function () {
                h(this).rating("select")
            }).data("rating", t)));
            var e, l, d,
                c = h('<div role="text" aria-label="' + (this.title || this.value) + '" class="star-rating rater-' + t.serial + '"><a>' + this.value + "</a></div>");
            for (datum in s.append(c), this.id && c.attr("id", this.id), this.className && c.addClass(this.className), h(this).data()) c.data(datum, h(this).data(datum));
            t.half && (t.split = 2), "number" == typeof t.split && 0 < t.split && (e = (h.fn.width ? c.width() : 0) || t.starWidth, l = t.count % t.split, d = Math.floor(e / t.split), c.width(d).find("a").css({"margin-left": "-" + l * d + "px"})), t.readOnly ? c.addClass("star-rating-readonly") : c.addClass("star-rating-live").on("mouseover", function () {
                h(this).rating("fill"), h(this).rating("focus")
            }).on("mouseout", function () {
                h(this).rating("draw"), h(this).rating("blur")
            }).on("click", function () {
                h(this).rating("select")
            }), this.checked && (t.current = c), "A" == this.nodeName && h(this).hasClass("selected") && (t.current = c), a.css({
                position: "absolute",
                left: "-9999em"
            }), a.on("change.rating", function (t) {
                return !t.selfTriggered && void h(this).rating("select")
            }), c.data("rating.input", a.data("rating.star", c)), t.stars[t.stars.length] = c[0], t.inputs[t.inputs.length] = a[0], t.rater = n[i] = s, t.context = r, a.data("rating", t), s.data("rating", t), c.data("rating", t), r.data("rating", n), r.data("rating" + i, s)
        }), h(".rating-to-be-drawn").rating("draw").removeClass("rating-to-be-drawn"), this
    }, h.extend(h.fn.rating, {
        calls: 0, focus: function () {
            var t = this.data("rating");
            if (!t) return this;
            if (!t.focus) return this;
            var a = h(this).data("rating.input") || h("INPUT" == this.tagName ? this : null);
            t.focus && t.focus.apply(a[0], [a.val(), h("a", a.data("rating.star"))[0]])
        }, blur: function () {
            var t = this.data("rating");
            if (!t) return this;
            if (!t.blur) return this;
            var a = h(this).data("rating.input") || h("INPUT" == this.tagName ? this : null);
            t.blur && t.blur.apply(a[0], [a.val(), h("a", a.data("rating.star"))[0]])
        }, fill: function () {
            var t = this.data("rating");
            if (!t) return this;
            t.readOnly || (this.rating("drain"), this.prevAll().addBack().filter(".rater-" + t.serial).addClass("star-rating-hover"))
        }, drain: function () {
            var t = this.data("rating");
            if (!t) return this;
            t.readOnly || t.rater.children().filter(".rater-" + t.serial).removeClass("star-rating-on").removeClass("star-rating-hover")
        }, draw: function () {
            var t = this.data("rating");
            if (!t) return this;
            this.rating("drain");
            var a = h(t.current), i = a.length ? a.prevAll().addBack().filter(".rater-" + t.serial) : null;
            i && i.addClass("star-rating-on"), t.cancel[t.readOnly || t.required ? "hide" : "show"](), this.siblings()[t.readOnly ? "addClass" : "removeClass"]("star-rating-readonly")
        }, select: function (t, a) {
            var i = this.data("rating");
            if (!i) return this;
            if (!i.readOnly) {
                if (i.current = null, void 0 !== t || 1 < this.length) {
                    if ("number" == typeof t) return h(i.stars[t]).rating("select", void 0, a);
                    if ("string" == typeof t) return h.each(i.stars, function () {
                        h(this).data("rating.input").val() == t && h(this).rating("select", void 0, a)
                    }), this
                } else i.current = "INPUT" == this[0].tagName ? this.data("rating.star") : this.is(".rater-" + i.serial) || this.is(".rater-cancel-" + i.serial) ? this : null;
                this.data("rating", i), this.rating("draw");
                var r = h(i.current ? i.current.data("rating.input") : null), n = h(i.inputs).filter(":checked");
                return h(i.inputs).not(r).prop("checked", !1), r.prop("checked", !0), h(r.length ? r : n).trigger({
                    type: "change",
                    selfTriggered: !0
                }), (a || void 0 === a) && i.callback && i.callback.apply(r[0], [r.val(), h("a", i.current)[0]]), this
            }
        }, readOnly: function (t, a) {
            var i = this.data("rating");
            if (!i) return this;
            i.readOnly = !(!t && void 0 !== t), a ? h(i.inputs).attr("disabled", "disabled") : h(i.inputs).removeAttr("disabled"), this.data("rating", i), this.rating("draw")
        }, disable: function () {
            this.rating("readOnly", !0, !0)
        }, enable: function () {
            this.rating("readOnly", !1, !1)
        }
    }), h.fn.rating.options = {cancel: "Cancel Rating", cancelValue: "", split: 0, starWidth: 16}, h(function () {
        h("input[type=radio].star").rating()
    })
}(jQuery);
