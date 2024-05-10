import { GroupRepository } from "../repositories/group";
import { Group } from "@prisma/client";

export class GroupService {
    private groupRepository: GroupRepository;

    constructor(groupRepository: GroupRepository) {
        this.groupRepository = groupRepository;
    }

    async createGroup(masterId: number, groupName: string): Promise<Group | boolean>{
        return this.groupRepository.createGroup(masterId, groupName);
    }

    async renameGroup(id: number, newName: string): Promise<Group | null>{
        return this.groupRepository.renameGroup(id,newName);
    }

    async getGroupById(id: number): Promise<Group | null> {
        return this.groupRepository.getGroupById(id);
    }

    async getGroupByName(name: string): Promise<Group[] | null> {
        return this.groupRepository.getGroupByName(name);
    }

    async deleteGroup(id: number) {
        await this.groupRepository.deleteGroup(id);
    }
}