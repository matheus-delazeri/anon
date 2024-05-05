import { UserRepository } from '../repositories/user';
import { User } from '@prisma/client';

export class UserService {
    private userRepository: UserRepository;

    constructor(userRepository: UserRepository) {
        this.userRepository = userRepository;
    }

    async createUser(hash: string): Promise<User | boolean> {
        return this.userRepository.createUser(hash);
    }

    async getUserById(id: number): Promise<User | null> {
        return this.userRepository.getUserById(id);
    }

    async deleteUser(id: number): Promise<void> {
        await this.userRepository.deleteUser(id);
    }
}
