import { create } from "zustand";

export const UseStore = create((set) => ({
    isAuth: false,
    user: {},
    setAuth: (input) => set((state) => ({ isAuth: input })),
    removeAuth: () => set({ isAuth: false }),
    setUser: (input) => set((state) => ({ user: input })),
    removeUser: () => set({ user: null }),

    userRegister: {
        main_sponsor_id: "",
        select_sponsor_id: "",
        refer_position: "",
        product_id: "",
        first_name: "",
        last_name: "",
        username: "",
        email: "",
        phone: "",
        password: "",
        epin_code: "",
    },
    product: {},
    setProduct: (input) => set({ product: input }),
    removeUserRegister: () =>
        set(() => ({
            userRegister: {
                main_sponsor_id: "",
                select_sponsor_id: "",
                product_id: "",
                first_name: "",
                last_name: "",
                username: "",
                email: "",
                phone: "",
                password: "",
                epin_code: "",
            },
        })),
}));
