import { $Enums, UserGroup } from "@prisma/client";

import { UserGroupRepository } from "../repositories/userGroup";


export class UserGroupService {
    private userGroupRepository: UserGroupRepository;

    constructor(userGroupRepository: UserGroupRepository){
        this.userGroupRepository = userGroupRepository;
    }

    //Search
    async getUserGroup(userId: number, groupId: number): Promise<UserGroup | null>{
        return this.userGroupRepository.getUserGroup(userId, groupId);
    }

    async getUsersFromGroup(groupId: number): Promise<UserGroup[] | null>{
        return this.userGroupRepository.getUsersFromGroup(groupId);
    }

    async getGroupsOfUser(userId: number): Promise<UserGroup[] | null>{
        return this.userGroupRepository.getGroupsOfUser(userId);
    }

    //Manipulation
    async addUserToGroup(requesterId: number, userId: number, groupId: number, role: string): Promise<UserGroup>{
        const requester = await this.getUserGroup(requesterId, groupId);

        if (!requester){
            throw new Error("Invalid requester");
        }
        else{
            if(requester.role == $Enums.Role.ADMIN || requester.role == $Enums.Role.MODERATOR){
                return this.userGroupRepository.addUserToGroup(userId, groupId, this.stringToRole(role));
            }
            else{
                throw new Error("Access denied");
            }
        }
    }

    async updateRole(requesterId: number,userId: number, groupId: number, role: string): Promise<UserGroup | null>{
        const requester = await this.getUserGroup(requesterId, groupId);

        if (!requester){
            throw new Error("Invalid requester");
        }
        else{
            if(requester.role == $Enums.Role.ADMIN || requester.role == $Enums.Role.MODERATOR){
                return this.userGroupRepository.updateRole(userId, groupId, this.stringToRole(role));
            }
            else{
                throw new Error("Access denied");
            }
        }
    }

    async deleteUserFromGroup(requesterId: number,userId: number, groupId: number): Promise<Boolean>{
        const requester = await this.getUserGroup(requesterId, groupId);

        if (!requester){
            throw new Error("Invalid requester");
        }
        else{
            if(requester.role == $Enums.Role.ADMIN || requester.role == $Enums.Role.MODERATOR){
                return this.userGroupRepository.deleteUserFromGroup(userId, groupId);
            }
            else{
                throw new Error("Access denied");
            }
        }
    }

    //Manipulation when deleting a group or user (inside the system)
    async deleteAllUsersFromGroup(groupId: number): Promise<Boolean>{
        return this.userGroupRepository.deleteAllUsersFromGroup(groupId);
    }

    async deleteAllGroupsFromUser(userId: number): Promise<Boolean>{
        return this.userGroupRepository.deleteAllGroupsFromUser(userId);
    }

    //Conversion of a string role for a Role role
    private stringToRole(role: string): $Enums.Role{
        switch (role) {   
            case 'N':
                return $Enums.Role.NORMAL;  
            case 'A':
                return $Enums.Role.ADMIN;
            case 'M':
                return $Enums.Role.MODERATOR; 
            default:
                throw new Error("Invalid role");
        }
    }
}