import { useUserStore } from "~/stores";
import type { ServiceResponse } from "./api.types";
import { api } from "./axios";

interface UserToken {
  accessToken: string;
  tokenType: string;
  expiresIn: number;
}

interface GoogleLoginRequest {
  email: string;
  name: string;
  googleToken: string;
}

export const googleLogin = {
  mutation: async (params: GoogleLoginRequest) => {
    const response = await api.post<ServiceResponse<UserToken>>(
      "/auth/google",
      {
        ...params,
      },
    );
    return response.data;
  },
};

export const logout = () => {
  const { clearUser } = useUserStore.getState();

  clearUser();
};
