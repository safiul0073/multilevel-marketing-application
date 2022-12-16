import create from 'zustand'

export const UseStore = create(set => ({
    isAuth: false,
    user: {},
    setAuth: (input) => set((state) => ({ isAuth: input })),
    removeAuth: () => set({ isAuth: false }),
    setUser: (input) => set((state) => ({ user: input })),
    removeUser: () => set({ user: null }),

    userRegister: {},
    setUserRegister: (input) => set({userRegister: input}),
    removeUserRegister: () => set(() => ({userRegister:{}}))
}))
