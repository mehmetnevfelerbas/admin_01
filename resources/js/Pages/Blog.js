import axios from "axios";
import Swal from "sweetalert2";

export class Blog {
    constructor() {
        this.load();
    }

    load() {
        this.events();
        this.getData();

        if ($(".blog_id").val() != null && $(".blog_id").val() != "") {
            this.getBlogData();
        }
    }

    events() {
        let self = this;
        $("body")
            .on("change", ".list-cmb", function () {
                self.getData();
            })
            .on("click", ".passiveBtn", function () {
                const id = $(this).parents("tr").attr("data-id");
                self.passive(id);
            })
            .on("click", ".activeBtn", function () {
                const id = $(this).parents("tr").attr("data-id");
                self.active(id);
            })
            .on("click", ".deleteBtn", function () {
                const id = $(this).parents("tr").attr("data-id");
                self.delete(id);
            })
            .on("click", ".blogSaveBtn", function () {
                self.save();
            })
            .on("change", ".lang", function () {
                self.getBlogData();
            });
    }

    getData() {
        $("#blogTable").DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            scrollY: "45vh",
            select: true,
            ajax: {
                url: "/api/blogs/getData",
                type: "POST",
                data: function (d) {
                    d.type = $(".type-cmb").val();
                    d.status = $(".status-cmb").val();
                },
            },
            columns: [
                { data: "title", name: "title" },
                { data: "description", name: "description" },
                { data: "type_name", name: "type_name" },
                { data: "status_name", name: "status_name" },
                { data: "action", name: "action" },
            ],
        });
    }

    async passive(id) {
        const self = this;
        const onay = await Swal.fire({
            title: "Emin misiniz?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Evet",
            cancelButtonText: "Hayır",
        });

        if (!onay.isConfirmed) return;

        const { data } = await axios.post("/api/blogs/passive", {
            blog_id: id,
        });
        if (data && data.status) {
            Swal.fire({
                title: "Bilgi",
                text: data.message,
                icon: "success",
            }).then(() => {});
            self.getData();
        } else {
            Swal.fire("Hata", data.message, "error");
        }
    }

    async active(id) {
        const self = this;
        const onay = await Swal.fire({
            title: "Emin misiniz?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Evet",
            cancelButtonText: "Hayır",
        });

        if (!onay.isConfirmed) return;

        const { data } = await axios.post("/api/blogs/active", { blog_id: id });
        if (data && data.status) {
            Swal.fire({
                title: "Bilgi",
                text: data.message,
                icon: "success",
            }).then(() => {});
            self.getData();
        } else {
            Swal.fire("Hata", data.message, "error");
        }
    }

    async delete(id) {
        const self = this;
        const onay = await Swal.fire({
            title: "Emin misiniz?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Evet",
            cancelButtonText: "Hayır",
        });

        if (!onay.isConfirmed) return;

        const { data } = await axios.post("/api/blogs/delete", { blog_id: id });
        if (data && data.status) {
            Swal.fire({
                title: "Bilgi",
                text: data.message,
                icon: "success",
            }).then(() => {});
            self.getData();
        } else {
            Swal.fire("Hata", data.message, "error");
        }
    }

    async save() {
        const formData = new FormData();
        formData.append("title", $(".title").val());
        formData.append("description", $(".description").val());
        formData.append("type", $(".type").val());
        formData.append("status", $(".status").val());
        formData.append("content", $(".content_text").val());
        formData.append("lang", $(".lang").val());
        formData.append("blog_id", $(".blog_id").val());

        // formData.append("image", $(".image")[0].files[0]);

        const { data } = await axios.post("/api/blogs/save", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        if (data && data.status) {
            Swal.fire({
                title: "Bilgi",
                text: data.message,
                icon: "success",
            }).then(() => {
                window.location.href = "/blog";
            });
        } else {
            Swal.fire("Hata", data.message, "error");
        }
    }

    async getBlogData() {
        const { data } = await axios.post("/api/blogs/getBlogData", {
            blog_id: $(".blog_id").val(),
            lang_code: $(".lang").val(),
        });

        if (data && data.status) {
            if (data.data != null) {
                $(".title").val(data.data.title);
                $(".description").val(data.data.description);
                $(".type").val(data.data.type_id);
                $(".status").val(data.data.status);
                $(".content_text").val(data.data.content);
            } else {
                $(".title").val("");
                $(".description").val("");
                $(".type").val(1);
                $(".status").val(1);
                $(".content_text").val("");
            }
        }
    }
}
